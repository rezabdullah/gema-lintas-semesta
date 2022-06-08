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
            'view shipment', 'create pickup shipment', 'create pickup shipment', 
            'view shipment', 'view delivery shipment', 'create delivery shipment', 
            'create delivery shipment', 'delete delivery shipment', 'view cost rate', 
            'add cost rate', 'add cost rate', 'edit cost rate', 'edit cost rate', 
            'delete cost rate', 'view partner', 'add partner', 'add partner', 'edit partner', 
            'edit partner', 'delete partner', 'view warehouse', 'add warehouse', 'add warehouse', 
            'edit warehouse', 'edit warehouse', 'delete warehouse', 'view admin', 'add admin', 
            'add admin', 'edit admin', 'edit admin', 'delete admin', 'view admin role', 
            'manage admin role', 'manage admin role'
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
