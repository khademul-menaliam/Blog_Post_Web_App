<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use App\Models\User;

class AdminProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $admin = Auth::user(); // ✅ This gets the currently logged-in user
        $roles = Role::latest()->get();
        return view('admin.profile.index', compact('admin','roles'));
    }

}
