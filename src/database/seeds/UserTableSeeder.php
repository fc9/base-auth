<?php

namespace Fc9\Auth\Database\Seeders;

use Fc9\Auth\entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = improve(config('auth::parameters.user.status'));
        $access_profile = improve(config('auth::parameters.user.access_profile'));
        $activeIn = date('Y/m/d H:i:s', strtotime('+ 1 second'));
        $createdIn = date('Y/m/d H:i:s');

        $username = improveRules(config('auth::validation.rules.username'));
        $root = \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random($username->max));

        User::insert([
            [
                'id' => 1,
                'indicator_id' => null,
                'username' => 'superuser',
                'email' => 'morenwm@gmail.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('m0r3N111'),
                'status' => $status->active,
                'access_profile' => $access_profile->superuser,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 2,
                'indicator_id' => null,
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('&a5yeeex'),
                'status' => $status->active,
                'access_profile' => $access_profile->admin,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 3,
                'indicator_id' => null,
                'username' => $root,
                'email' => $root . '@root.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make($root),
                'status' => $status->active,
                'access_profile' => $access_profile->root,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 4,
                'indicator_id' => 3,
                'username' => 'brunas',
                'email' => 'brunasouza@tester.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('teste123'),
                'status' => $status->active,
                'access_profile' => $access_profile->member,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
        ]);
    }
}
