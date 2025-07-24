<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;
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

    public function index(Request $request)
    {
        $query = Blog::query()->with(['user', 'category']);

        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $blogs = $query->get();
        $category = Category::all();
        $latestPost = Blog::latest()->limit(6)->get();
        return view('admin.blogs.index', compact('blogs', 'category', 'latestPost'));

    }
    public function show($id)
    {

        $post = Blog::find( $id);
        return view('admin.blogs.show', compact('post'));
    }

    public function create()
    {
        $categores = Category::all();
        $users = User::all();
        return view('admin.blogs.create', compact('categores', 'users'));
    }

    public function store(Request $request)
    {
        try {
            // Validation (let Laravel handle errors)
            $request->validate([
                'postTitle' => 'required|string|max:255',
                'postSlug' => 'required|string|max:255',
                'postCategory' => 'required|exists:categories,id',
                'Author' => 'required|exists:users,id',
                'description' => 'required|string',
                'postDate' => 'required|date',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'metaTitle' => 'nullable|string|max:60',
                'metaDescription' => 'nullable|string|max:160',
                'keywords' => 'nullable|array',
                'status' => 'required',

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

            // Ensure unique slug
            $originalSlug = $request->postSlug;
            $slug = $originalSlug;
            if (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . uniqid();
            }


            $metaKeywords = null;
            if ($request->has('keywords')) {
                $metaKeywords = implode(', ', $request->keywords);
            }

            if ($request->has('is_banner')) {
                Blog::where('is_banner', 1)->update(['is_banner' => 0]);
            }


            // Create the blog post
            $blog = Blog::create([
                'title' => $request->postTitle,
                'slug' => $slug,
                'description' => $request->description,
                'category_id' => $request->postCategory,
                'user_id' => $request->Author,
                'img' => $imagePath,
                'meta_title' => $request->metaTitle,
                'meta_description' => $request->metaDescription,
                'meta_keywords' => $metaKeywords,
                'status' => $request->status,
                'created_at' => $request->postDate,
                'updated_at' => now(),
                'is_banner' => $request->has('is_banner') ? 1 : 0,
            ]);

            return redirect()->route('admin.blogs.index')
                ->with('success', 'Blog post created successfully!');

        }

        catch (\Exception $e) {
            // Log the error for debugging
            // Log::error('Blog creation error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with([
                    'error' => 'Failed to create blog post. Please try again.',
                    'error_detail' => $e->getMessage()
                ]);
        }
    }
    public function edit($id)
    {
        $post = Blog::findOrFail($id);
        $categores = Category::all();
        $users = User::all();
        return view('admin.blogs.edit', compact('post', 'categores', 'users'));
    }

    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);
        $request->validate([
            'postTitle' => 'required|string|max:255',
            'postCategory' => 'required|exists:categories,id',
            'Author' => 'required|exists:users,id',
            'description' => 'required|string',
            'postDate' => 'required|date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'metaTitle' => 'nullable|string|max:60',
            'metaDescription' => 'nullable|string|max:160',
            'keywords' => 'nullable|array',
            'status' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($post->img && file_exists(public_path('assets/images/blog/' . $post->img))) {
                unlink(public_path('assets/images/blog/' . $post->img));
            }
            $image = $request->file('img');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/blog');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $post->img = $imageName;
        }

        $metaKeywords = null;
        if ($request->has('keywords')) {
            $metaKeywords = implode(', ', $request->keywords);
        }
        if ($request->has('is_banner')) {
            Blog::where('is_banner', 1)->where('id', '!=', $post->id)->update(['is_banner' => 0]);
        }

        $post->title = $request->postTitle;
        $post->description = $request->description;
        $post->category_id = $request->postCategory;
        $post->user_id = $request->Author;
        $post->meta_title = $request->metaTitle;
        $post->meta_description = $request->metaDescription;
        $post->meta_keywords = $metaKeywords;
        $post->status = $request->status;
        $post->created_at = $request->postDate;
        $post->updated_at = now();
        $post->is_banner = $request->has('is_banner') ? 1 : 0;
        $post->save();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Blog::findOrFail($id);
        // Delete image if exists
        if ($post->img && file_exists(public_path('assets/images/blog/' . $post->img))) {
            unlink(public_path('assets/images/blog/' . $post->img));
        }
        $post->delete();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
