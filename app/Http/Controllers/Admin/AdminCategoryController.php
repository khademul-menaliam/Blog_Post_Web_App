<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function show($id)
    {
        $post = Category::find( $id);
        return view('admin.category.show', compact('post'));
    }
    public function create()
    {
        $users = User::all();
        return view('admin.category.create', compact('users'));
    }
    public function store(Request $request)
    {
        try {
            // Validation (let Laravel handle errors)
            $request->validate([
                'postTitle' => 'required|string|max:255',
                'postSlug' => 'required|string|max:255',
                'Author' => 'required|exists:users,id',
                'postDate' => 'required|date',
                'metaTitle' => 'nullable|string|max:60',
                'metaDescription' => 'nullable|string|max:160',
                'keywords' => 'nullable|array',
            ]);

            // Ensure unique slug
            $originalSlug = $request->postSlug;
            $slug = $originalSlug;
            if (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . uniqid();
            }
            $metaKeywords = null;
            if ($request->has('keywords')) {
                $metaKeywords = implode(', ', $request->keywords);
            }

            // Create the Category
            $category = Category::create([
                'title' => $request->postTitle,
                'slug' => $slug,
                'category_id' => $request->postCategory,
                'user_id' => $request->Author,
                'meta_title' => $request->metaTitle,
                'meta_description' => $request->metaDescription,
                'meta_keywords' => $metaKeywords,
                'created_at' => $request->postDate,
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.category.index')
                ->with('success', 'Category created successfully!');
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
        $post = Category::findOrFail($id);
        $categores = Category::all();
        $users = User::all();
        return view('admin.category.edit', compact('post', 'categores', 'users'));
    }

    public function update(Request $request, $id)
    {
        $post = Category::findOrFail($id);
        $request->validate([
            'postTitle' => 'required|string|max:255',
            'Author' => 'required|exists:users,id',
            'postDate' => 'required|date',
            'metaTitle' => 'nullable|string|max:60',
            'metaDescription' => 'nullable|string|max:160',
            'keywords' => 'nullable|array',
        ]);


        $metaKeywords = null;
        if ($request->has('keywords')) {
            $metaKeywords = implode(', ', $request->keywords);
        }

        $post->title = $request->postTitle;
        $post->user_id = $request->Author;
        $post->meta_title = $request->metaTitle;
        $post->meta_description = $request->metaDescription;
        $post->meta_keywords = $metaKeywords;
        $post->created_at = $request->postDate;
        $post->updated_at = now();
        $post->save();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $post = Category::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully!');
    }

}
