<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.blogs.create');
    }

            public function show($id)
    {

        $post = Blog::find( $id);

        return view('admin.blogs.show', compact('post'));
    }


}
