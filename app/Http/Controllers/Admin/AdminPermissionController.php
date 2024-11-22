<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:voir les permissions', ['only' => ['all_permissions']]);
        $this->middleware('permission:créer permission', ['only' => ['add_permission', 'store_permission']]);
        $this->middleware('permission:mettre à jour le permission', ['only' => ['update_permission', 'edit_permission']]);
        $this->middleware('permission:supprimer permission', ['only' => ['delete_permission']]);
    }

    public function all_permissions()
    {
        $permissions = Permission::get();
        Log::info($permissions );
        return view('permissions.all_permissions', ['permissions' => $permissions]);
    }

    public function add_permission()
    {
        return view('permissions.add_permission');
    }

    public function store_permission(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name,
            'permission_cat' => $request->permission_cat
        ]);

        return redirect('admin/all/permissions')->with('status', 'Permission Created Successfully');
    }

    public function edit_permission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit_permission', ['permission' => $permission]);
    }

    public function update_permission(Request $request,  $id)
    {
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name,
            'permission_cat' => $request->permission_cat
        ]);

        return redirect('admin/all/permissions')->with('status', 'Permission Updated Successfully');
    }

    public function delete_permission($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('admin/all/permissions')->with('status', 'Permission Deleted Successfully');
    }
}
