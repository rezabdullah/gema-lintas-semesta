<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(env('TABLE_PAGINATE'));

        return view('backoffice.roles.index', compact('roles'));
    }

    public function edit(Role $role)
    {
        $permissionsAvailable = Permission::all();

        foreach ($permissionsAvailable as $key => $permission) {

            $permission['isChoosed'] = false;
        
            foreach ($role->permissions as $rolePermission) {
                if ($permission->id == $rolePermission->id) {
                    $permission['isChoosed'] = true;
                    break;
                }
            }
        }

        $role->permissions = $permissionsAvailable;

        return view('backoffice.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.edit', $role->id)->with('success', 'Data berhasil diupdate');
    }
}
