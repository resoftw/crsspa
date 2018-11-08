<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        $admin = \App\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin.crs@semenbaturaja.co.id',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'remember_token' => str_random(10),
        ]);
//        $usr->assignRole('admin');
        $user = \App\User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user.crs@semenbaturaja.co.id',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'remember_token' => str_random(10),
        ]);
//        $usr->assignRole('user');

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
        $user->assignRole($role);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['manage news', 'manage contents', 'manage surveys']);

        $role = Role::create(['name' => 'customer service']);
        $role->givePermissionTo('manage tickets');

        $role = Role::create(['name' => 'sysadmin']);
        $role->givePermissionTo(Permission::all());
        $admin->assignRole($role);
    }
}