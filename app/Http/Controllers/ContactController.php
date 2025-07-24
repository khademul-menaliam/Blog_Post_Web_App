<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category; // Assumes you have a Category model
use App\Models\Contact;

class ContactController extends Controller
{
    // Display a listing of the blogs
    public function index()
    {
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        $categories = Category::all();
        // Generate simple captcha
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['contact_captcha_sum' => $num1 + $num2]);
        return view('pages.contact', compact('latestPost', 'categories', 'num1', 'num2'));

        // $blogs = Blog::all();
        // return view('blogs.index', compact('blogs'));
    }
        public function store(Request $request)
    {
        // Validate incoming request data
        // dd($request->all());
        $validatedData = $request->validate([
            'name'   => 'required|string|max:255',
            'email' => 'required|email',
            'subjects'   => 'required|string|max:255',
            'message' => 'required|string',
            'captcha_answer' => 'required|numeric',
        ]);
        // Check captcha
        if ((int)$request->input('captcha_answer') !== (int)session('contact_captcha_sum')) {
            return redirect()->back()->withInput()->withErrors(['captcha_answer' => 'Incorrect captcha answer. Please try again.']);
        }
        // Create and save the contact
        Contact::create($request->except(['captcha_answer']));
        return redirect()->route('contact.index')->with('success', 'Contact query created successfully.');
    }
}
