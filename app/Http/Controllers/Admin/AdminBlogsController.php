<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminBlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::all();
        $category = Category::all();
        $latestPost = Blog::latest()->limit(6)->get();
        return view('admin.blogs.index', compact('blogs', 'category', 'latestPost'));

    }

        public function create()
    {
        $categores = Category::all();
        $users = User::all();
        return view('admin.blogs.create', compact('categores', 'users'));
    }


            public function show($id)
    {

        $post = Blog::find( $id);

        return view('admin.blogs.show', compact('post'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'postTitle' => 'required|string|max:255',
                'postSlug' => 'required|string|max:255|unique:posts,slug',
                'postCategory' => 'required|exists:categories,id',
                'Author' => 'required|exists:users,id',
                'description' => 'required|string',
                'postDate' => 'required|date',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'metaTitle' => 'nullable|string|max:255',
                'metaDescription' => 'nullable|string',
                'keywords' => 'nullable|string|max:255',
            ]);

            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/images/blog');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                // Save relative path to database
                $imagePath = $imageName;
            }

            // Create the blog post
            $blog = Blog::create([
                'title' => $request->postTitle,
                'slug' => $request->postSlug,
                'description' => $request->description,
                'category_id' => $request->postCategory,
                'user_id' => $request->Author,
                'img' => $imagePath,
                'meta_title' => $request->metaTitle,
                'meta_description' => $request->metaDescription,
                'meta_keywords' => $request->keywords,
                'created_at' => $request->postDate,
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog post created successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Blog creation error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create blog post. Please try again.');
        }
    }

}
