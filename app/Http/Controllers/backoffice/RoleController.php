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
        $permissions = Permission::all();

        return view('backoffice.roles.edit', compact('role', 'permissions'));
    }
}
