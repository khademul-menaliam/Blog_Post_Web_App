<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use App\Models\Advertisement;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $adds = Advertisement::all();
        return view('admin.roles.index');
    }
    public function create()
    {
        $permissions =Permission::all()->groupBy('group_name');
        return view('admin.roles.create', compact('permissions'));
    }


    // public function show($id)
    // {
    //     $post = Advertisement::find( $id);
    //     return view('admin.advertisement.show', compact('post'));
    // }



    // public function store(Request $request)
    // {
    //     try {
    //         // Validation (let Laravel handle errors)
    //         $request->validate([
    //             'postTitle' => 'required|string|max:255',
    //             'link' => 'required|string|max:255',
    //             'postDate' => 'required|date',
    //             'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'status' => 'required',

    //         ]);

    //         // Handle file upload
    //         $imagePath = null;
    //         if ($request->hasFile('img')) {
    //             $image = $request->file('img');
    //             $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    //             $destinationPath = public_path('assets/images');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0755, true);
    //             }

    //             $image->move($destinationPath, $imageName);
    //             // Save relative path to database
    //             $imagePath = $imageName;
    //         }

    //         // Create the blog post
    //         $adds = Advertisement::create([
    //             'name' => $request->postTitle,
    //             'link' => $request->link,
    //             'img' => $imagePath,
    //             'status' => $request->status,
    //             'created_at' => $request->postDate,
    //             'updated_at' => now(),
    //         ]);

    //         return redirect()->route('admin.advertisement.index')
    //             ->with('success', 'Advertisement created successfully!');

    //     }

    //     catch (\Exception $e) {
    //         // Log the error for debugging
    //         // Log::error('Blog creation error: ' . $e->getMessage());

    //         return redirect()->back()
    //             ->withInput()
    //             ->with([
    //                 'error' => 'Failed to create Advertisement. Please try again.',
    //                 'error_detail' => $e->getMessage()
    //             ]);
    //     }
    // }

    // public function edit($id)
    // {
    //     $post = Advertisement::findOrFail($id);
    //     return view('admin.advertisement.edit', compact('post'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $post = Advertisement::findOrFail($id);
    //     $request->validate([
    //             'postTitle' => 'required|string|max:255',
    //             'link' => 'required|string|max:255',
    //             'postDate' => 'required|date',
    //             'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'status' => 'required',
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('img')) {
    //         // Delete old image if exists
    //         if ($post->img && file_exists(public_path('assets/images/' . $post->img))) {
    //             unlink(public_path('assets/images/' . $post->img));
    //         }
    //         $image = $request->file('img');
    //         $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('assets/images');
    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0755, true);
    //         }
    //         $image->move($destinationPath, $imageName);
    //         $post->img = $imageName;
    //     }


    //     $post->name = $request->postTitle;
    //     $post->link = $request->link;
    //     $post->status = $request->status;
    //     $post->created_at = $request->postDate;
    //     $post->updated_at = now();
    //     $post->save();

    //     return redirect()->route('admin.advertisement.index')
    //         ->with('success', 'advertisement updated successfully!');
    // }

    // public function destroy($id)
    // {
    //     $post = Advertisement::findOrFail($id);
    //     // Delete image if exists
    //     if ($post->img && file_exists(public_path('assets/images/' . $post->img))) {
    //         unlink(public_path('assets/images/' . $post->img));
    //     }
    //     $post->delete();
    //     return redirect()->route('admin.advertisement.index')
    //         ->with('success', 'Advertisement deleted successfully!');
    // }
}
