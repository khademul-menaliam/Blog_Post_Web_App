<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $admin = DB::table('users')->first();
        $roles = Role::latest() ->get();
        return view('admin.profile.show', compact('admin','roles'));
    }

}
