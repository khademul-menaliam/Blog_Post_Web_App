<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Category;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        $content = DB::table('about')->first();
        return view('pages.about', compact('content','latestPost'));
    }

        public function disclaimer()
    {
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        $content = DB::table('disclaimer')->first();
        return view('pages.disclaimer', compact('content','latestPost'));
    }

}
