<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        $blogs = Blog::where('status',1)->latest()->limit(4)->get();
        $category = Category::withCount(['posts as posts_count' => function($query) {
            $query->where('status', 1);
        }])->get();
        $latestPost = Blog::where('status',1)->latest()->get();

        $mainBanner = Blog::where('status',1)->where('is_banner',1)->first();
        // dd($mainBanner);
        $othersBanner = Blog::where('status',1)->inRandomOrder()->limit('2')->get();
        $adBanner = DB::table('advertisement')->where('status',1)->inRandomOrder()->limit('1')->get();




        return view('welcome', compact('blogs', 'category','latestPost','mainBanner','othersBanner','adBanner' ));
    }

}
