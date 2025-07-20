<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class CategoryController extends Controller
{


            public function show($slug)
    {
        $categoryId = Category::where('slug', $slug)->firstOrFail();
        $blogs = Blog::where('status',1)->where('category_id' , $categoryId->id)-> get();
        $category = Category::all();
        $latestPost = Blog::where('status',1)->latest()->limit(4)->get();

        return view('blogs.category', compact('blogs', 'category','latestPost'));
    }


}
