<?php

use Illuminate\Database\Seeder;
//use Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin.crs@semenbaturaja.co.id',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'remember_token' => str_random(10),
        ]);

        $user = \App\User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user.crs@semenbaturaja.co.id',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'remember_token' => str_random(10),
        ]);

        Bouncer::refresh();

        Bouncer::role()->create([
            'name' => 'sysadmin',
            'title'=>'System Administrator',
        ]);

        Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);

        Bouncer::role()->create([
            'name'=>'user',
            'title'=>'User',
        ]);

        Bouncer::allow('sysadmin')->everything();

        Bouncer::ability()->create([
            'name' => 'manage-users',
            'title' => 'Manage users',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-surveys',
            'title' => 'Manage surveys',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-articles',
            'title' => 'Manage articles',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-products',
            'title' => 'Manage products',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-events',
            'title' => 'Manage events',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-distributors',
            'title' => 'Manage distributors',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-templates',
            'title' => 'Manage templates',
        ]);
        Bouncer::ability()->create([
            'name' => 'manage-tickets',
            'title' => 'Manage tickets',
        ]);

        Bouncer::assign('sysadmin')->to($admin);
        Bouncer::assign('user')->to($user);
    }
}

  