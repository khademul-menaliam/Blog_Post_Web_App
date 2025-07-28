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
        $roles = Role::with('permissions')->get();
        $totalPermissionsCount = Permission::count();
        return view('admin.roles.index', compact('roles','totalPermissionsCount'));
    }
    public function create()
    {
        $permissions =Permission::all()->groupBy('group_name');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {
            $role = Role::create(['name' => $request->name]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');

        } catch (\Exception $e) {

            return redirect()->route('admin.roles.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $role = Role::where('id', $id)->first(); // no guard check
        $permissions = Permission::all()->groupBy('group_name'); // All available permissions
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $allPermissionsCount = Permission::count();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions','allPermissionsCount'));
    }
    public function update(Request $request, $id)
    {
        // Let Laravel handle validation errors automatically
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {
            $role = Role::findById($id);
            $role->name = $request->name;
            $role->save();

            $role->syncPermissions($request->permissions ?? []);

            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findById($id);
            $role->delete();

            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.roles.index')->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }

}
