<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;

class TermsController extends Controller
{
    public function index()
    {
         $latestPost = Blog::where('status',1)->latest()->limit(6)->get();
        $content = DB::table('terms')->first();
        return view('pages.terms', compact('content','latestPost'));
    }
}
