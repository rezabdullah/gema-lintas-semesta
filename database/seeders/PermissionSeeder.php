<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect([
            'view payment method', 'add payment method', 'edit payment method', 'delete payment method', 
            'view admin', 'add admin', 'edit admin', 'delete admin', 
            'view admin role', 'manage admin role', 'view admin permission', 
            'manage admin permission', 'view product', 'add product', 
            'edit product', 'delete product', 'view product role', 'view product permission', 
            'manage product role', 'manage product permission', 
            'view template', 'add template', 'edit template', 'delete template', 
            'view order', 'manage order', 'view discount', 
            'add discount', 'edit discount', 'delete discount',
        ]);

        $permissions->each(function( $permission ) {
            if( count(Permission::where('name', $permission)->get()) < 1 ){
                Permission::create([
                    'name' => $permission
                ]);
            }
        });
    }
}
