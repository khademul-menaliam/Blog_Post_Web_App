<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status',1)->paginate(4);
        $category = Category::all();
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        return view('blogs.index', compact('blogs', 'category', 'latestPost'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('status',1)->where('title', 'like', "%{$query}%")
                     ->orWhere('description', 'like', "%{$query}%")
                     ->paginate(4);

        $blogs->appends(['query' => $query]);
        $category = Category::all();
        $latestPost = Blog::where('status',1)->latest()->limit(4)->get();
        return view('blogs.search', compact('blogs', 'category', 'latestPost'));
    }


        public function show($slug)
    {
        $blog = Blog::where('status',1)->where('slug' , $slug)-> firstOrFail();
        $category = Category::all();
        $latestPost = Blog::where('status',1)->latest()->limit(4)->get();
        $relatedPost = Blog::where('status',1)->where('category_id', $blog->category_id)
          ->where('id', '!=', $blog->id)->limit(2)->get();
         //dd($relatedPost);


        return view('blogs.show', compact('blog', 'category','latestPost','relatedPost'));
    }
    public function category($slug)
    {
        $category = Category::all();
        $currentCategory = Category::where('slug', $slug)->firstOrFail();
        $blogs = Blog::where('status',1)->where('category_id', $currentCategory->id)->latest()->get();
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        return view('blogs.category', compact('blogs', 'category', 'currentCategory', 'latestPost'));
    }
    // Show the form for creating a new blog
    // public function create()
    // {
    //     return view('blogs.create');
    // }
    // // Store a newly created blog in storage
    // public function store(Request $request)
    // {
    //     // Validate incoming request data
    //     $validatedData = $request->validate([
    //         'title'   => 'required|string|max:255',
    //         'content' => 'required|string',
    //     ]);
    //     // Create and save the blog
    //     Blog::create($validatedData);
    //     return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    // }
    // // Display the specified blog post
    // public function show($id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     return view('blogs.show', compact('blog'));
    // }
    // // Show the form for editing the specified blog
    // public function edit($id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     return view('blogs.edit', compact('blog'));
    // }
    // // Update the specified blog in storage
    // public function update(Request $request, $id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     // Validate request
    //     $validatedData = $request->validate([
    //         'title'   => 'required|string|max:255',
    //         'content' => 'required|string',
    //     ]);
    //     // Update blog with validated data
    //     $blog->update($validatedData);
    //     return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    // }
    // // Remove the specified blog from storage
    // public function destroy($id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     $blog->delete();
    //     return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    // }
}
