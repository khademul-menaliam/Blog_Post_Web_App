<?php

namespace App\Http\Controllers\Admin;
use App\Models\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.about.edit')->only(['about','aboutUpdate']);
        $this->middleware('can:admin.disclaimer.edit')->only(['disclaimer','disclaimerUpdate']);
    }

    public function about()
    {
        $post = DB::table('about')->first();
        return view('admin.pages.about', compact('post'));
    }
    public function aboutUpdate(Request $request, $id)
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

    public function disclaimer()
    {
        $post = DB::table('disclaimer')->first();
        return view('admin.pages.disclaimer', compact('post'));
    }
    public function disclaimerUpdate(Request $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('metatitle'),
            'meta_description' => $request->input('meta_desc'),
            'meta_keywords' => is_array($request->input('keywords')) ? implode(',', $request->input('keywords')) : $request->input('meta_keywords'),
            'created_at' => $request->input('postDate'),
        ];

        DB::table('disclaimer')->where('id', $id)->update($data);

        return redirect()->route('admin.pages.disclaimer')->with('success', 'Disclaimer updated successfully!');
    }

    public function contact()
    {
        $contacts = Contact::all();
        return view('admin.pages.contact', compact('contacts'));
    }
        public function contactDestroy()
    {
        $post = DB::table('disclaimer')->first();
        return view('admin.pages.disclaimer', compact('post'));
    }





}
