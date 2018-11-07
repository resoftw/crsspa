<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usr=\App\User::create([
        	'name'=>'Administrator',
            'username'=>'admin',
        	'email'=>'admin.crs@semenbaturaja.co.id',
        	'password'=>password_hash('password', PASSWORD_BCRYPT),
        	'remember_token'=>str_random(10),
        ]);
        $this->call(RolesAndPermissionsSeeder::class);
        $usr->assignRole('sys-admin');

    }
}
