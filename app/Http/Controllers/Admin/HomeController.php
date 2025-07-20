<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Blog;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::latest()->take(5)->get();
        $blogs = Blog::latest()->take(5)->get();
        $totalcategories = Category::count();
        $totalblogs = Blog::count();
        $totaldraftblogs = Blog::where('status',0)->count();
        $totalpublishedblogs = Blog::where('status',1)->count();
        return view('admin.home', compact('categories','blogs', 'totalcategories','totalblogs','totaldraftblogs','totalpublishedblogs'));
    }

}
