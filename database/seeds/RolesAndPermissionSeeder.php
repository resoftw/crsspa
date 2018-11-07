<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'manage news']);
        Permission::create(['name' => 'manage contents']);
        Permission::create(['name' => 'manage surveys']);
        Permission::create(['name' => 'manage tickets']);
        Permission::create(['name' => 'manage users']);


        // create roles and assign created permissions

        $role = Role::create(['name' => 'user']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['manage news', 'manage contents', 'manage surveys']);

        $role = Role::create(['name' => 'customer service']);
        $role->givePermissionTo('manage tickets');

        $role = Role::create(['name' => 'sys-admin']);
        $role->givePermissionTo(Permission::all());
    }
}