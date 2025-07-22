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
        $category = Category::withCount(['posts as posts_count' => function($query) {
            $query->where('status', 1);
        }])->get();
        //dd($category);
        $latestPost = Blog::where('status',1)->latest()->get();


        return view('welcome', compact('blogs', 'category','latestPost' ));
    }

}
