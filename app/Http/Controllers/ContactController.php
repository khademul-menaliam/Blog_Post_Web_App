<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category; // Assumes you have a Category model


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
}
