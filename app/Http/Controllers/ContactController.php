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
        $latestPost = Blog::latest()->limit(6)->get();
        $categories = Category::all();
        return view('pages.contact', compact('latestPost', 'categories'));

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
        ]);
        // Create and save the blog
        Contact::create($request->all());
        return redirect()->route('contact.index')->with('success', 'Contact query created successfully.');
    }
}
