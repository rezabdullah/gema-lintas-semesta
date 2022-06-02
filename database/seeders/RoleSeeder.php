<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            'super-admin', 'admin',
        ]);

        $roles->each(function( $role ) {
            if( count(Role::where('name', $role)->get()) < 1 ){
                Role::create([ 
                    'name' => $role
                ]);
            }
        });

        $permissions = Permission::get();
        $role = Role::where('name', 'super-admin')->first();
        $role->givePermissionTo($permissions);
    }
}
