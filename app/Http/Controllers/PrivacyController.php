<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;

class PrivacyController extends Controller
{
    public function index()
    {
        $latestPost = Blog::latest()->limit(6)->get();
        $content = DB::table('privacy')->first();
        return view('pages.privacy', compact('content','latestPost'));
    }
}
