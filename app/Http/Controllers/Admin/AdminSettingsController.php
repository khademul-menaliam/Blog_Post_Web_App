<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\file;

class AdminSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.settings.edit')->only(['index','update']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('settings')->first();

        return view('admin.settings.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = DB::table('settings')->first();
        $id = $data->id ?? 1;

        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'metaTitle' => 'nullable|string|max:60',
            'keywords' => 'nullable|array',
            'metaDescription' => 'nullable|string|max:160',
            'blog_metaTitle' => 'nullable|string|max:60',
            'blog_keywords' => 'nullable|array',
            'blog_metaDescription' => 'nullable|string|max:160',
        ]);

        $updateData = [
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'meta_title' => $request->metaTitle,
            'meta_keywords' => is_array($request->keywords) ? implode(',', $request->keywords) : null,
            'meta_description' => $request->metaDescription,
            'blog_meta_title' => $request->blog_metaTitle,
            'blog_meta_keywords' => is_array($request->blog_keywords) ? implode(',', $request->blog_keywords) : null,
            'blog_meta_description' => $request->blog_metaDescription,
        ];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('assets/images'), $logoName);
            $updateData['logo'] = $logoName;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('assets/images'), $faviconName);
            $updateData['fav_icon'] = $faviconName;
        }

        DB::table('settings')->where('id', $id)->update($updateData);

        // Clear settings cache if used
        Cache::forget('site_settings');

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

        public function create()
    {
        return view('admin.category.create');
    }


}
