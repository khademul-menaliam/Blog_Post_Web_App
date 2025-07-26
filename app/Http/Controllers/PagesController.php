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

    public function siteMap()
    {
        $categories = Category::get();
        $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        // $content = DB::table('sitemap')->first();
        return view('pages.sitemap', compact('latestPost','categories'));
    }
    public function xmlSiteMap()
    {
        $categories = Category::all();
        $blogs = Blog::all();
        return response()-> view('pages.xmlsitemap', compact('categories','blogs'))->header('Content-Type','application/xml');
    }

    // Advertisement count
    public function clickCount($id)
    {
        $count = DB::table('advertisement')->where('id', $id)->increment('clicks');
        $link = DB::table('advertisement')->where('id', $id)->first();
        return redirect()->away($link->link);
    }



}
