<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:voir les roles', ['only' => ['all_roles']]);
        $this->middleware('permission:créer role', ['only' => ['add_role', 'store_role', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:mettre à jour le role', ['only' => ['update_role', 'edit_role']]);
        $this->middleware('permission:supprimer role', ['only' => ['delete_role']]);
    }

    public function all_roles()
    {
        $roles = Role::get();
        Log::info($roles);
        return view('roles.all_roles', ['roles' => $roles]);
    }

    public function add_role()
    {
        return view('roles.add_role');
    }

    public function store_role(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name,
            'role_cat' => $request->role_cat
        ]);
       
        return redirect('admin/all/roles')->with('status', 'Role Created Successfully');
    }

    public function edit_role($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit_role', [
            'role' => $role
        ]);
    }

    public function update_role(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name,
            'role_cat' => $request->role_cat
        ]);

        return redirect('admin/all/roles')->with('status', 'Role Updated Successfully');
    }

    public function delete_role($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('admin/all/roles')->with('status', 'Role Deleted Successfully');
    }

    public function addPermissionToRole($id)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    // public function givePermissionToRole(Request $request, $id)
    // {
    //     $request->validate([
    //         'permission' => 'required'
    //     ]);

    //     $role = Role::findOrFail($id);
    //     $role->syncPermissions($request->permission);

    //     return redirect('all/roles')->with('status','Permissions added to role');
    // }
    public function givePermissionToRole(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->syncPermissions($request->input('permission'));

        return redirect('admin/all/roles')->with('status', 'Permissions added to role');
    }
}
