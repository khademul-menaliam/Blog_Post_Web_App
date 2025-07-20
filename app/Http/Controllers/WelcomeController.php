<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        $blogs = Blog::where('status',1)->latest()->limit(4)->get();
        $category = Category::all();
        $latestPost = Blog::where('status',1)->latest()->get();


        return view('welcome', compact('blogs', 'category','latestPost' ));
    }

}
