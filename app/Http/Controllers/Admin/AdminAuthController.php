<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog; // Assumes you have a Blog model
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminAuthController extends Controller
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

    public function index(Request $request)
    {
        $roles = Role::latest() ->get();
        $users = User::all();
        return view('admin.users.index', compact('users','roles'));

    }
    public function create()
    {
        $roles = Role::latest() ->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            // Validation (let Laravel handle errors)
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required',
                'dob' => 'nullable|date',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/images/users');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                // Save relative path to database
                $imagePath = $imageName;
            }

            // Create the blog user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password'   => Hash::make($request->password),
                'role_id' => $request->role,
                'img' => $imagePath,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'Users created successfully!');

        }

        catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'error' => 'Failed to create Users. Please try again.',
                    'error_detail' => $e->getMessage()
                ]);
        }
    }
    public function edit($id)
    {
        $roles = Role::latest() ->get();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact( 'user','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6',
            'role' => 'required',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($user->img && file_exists(public_path('assets/images/users/' . $user->img))) {
                unlink(public_path('assets/images/users/' . $user->img));
            }
            $image = $request->file('img');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/users');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $user->img = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        $user->updated_at = now();
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'user updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->posts()->count() > 0) {
        return redirect()->route('admin.users.index')
            ->with('error', 'Cannot delete user. First delete user releted blog posts.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'user deleted successfully!');

    }

}
