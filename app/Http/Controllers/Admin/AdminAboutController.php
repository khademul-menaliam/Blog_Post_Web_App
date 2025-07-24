<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminAboutController extends Controller
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
        $post = DB::table('about')->first();
        return view('admin.pages.about', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('metatitle'),
            'meta_description' => $request->input('meta_desc'),
            'meta_keywords' => is_array($request->input('keywords')) ? implode(',', $request->input('keywords')) : $request->input('meta_keywords'),
            'created_at' => $request->input('postDate'),
        ];

        DB::table('about')->where('id', $id)->update($data);

        return redirect()->route('admin.pages.about')->with('success', 'About Us updated successfully!');
    }



}
