<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HelpController extends Controller
{
    public function index()
    {
        $latestPost = Blog::latest()->limit(6)->get();
        return view('pages.help', compact('latestPost'));
    }

    public function show()
    {
     $latestPost = Blog::latest()->limit(6)->get();
        return view('pages.help', compact('latestPost'));
    }
}
