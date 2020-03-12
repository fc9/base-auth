<?php

namespace Fc9\Auth\Database\Seeders;

use Fc9\Auth\entities\User;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Str;
use YourAppRocks\EloquentUuid\Traits\Uuidable;

class UserTableSeeder extends Seeder
{
    use Uuidable;

=======

class UserTableSeeder extends Seeder
{
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = improve(config('auth::parameters.user.status'));
<<<<<<< HEAD
        //$access_profile = improve(config('auth::parameters.user.access_profile'));
        $activeIn = date('Y/m/d H:i:s', strtotime('+ 1 second'));
        $datedIn = date('Y/m/d H:i:s');

        $username = rules(config('auth::validation.rules.username'));
        $root = Str::lower(Str::random($username->max));
=======
        $access_profile = improve(config('auth::parameters.user.access_profile'));
        $activeIn = date('Y/m/d H:i:s', strtotime('+ 1 second'));
        $createdIn = date('Y/m/d H:i:s');

        $username = improveRules(config('auth::validation.rules.username'));
        $root = \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random($username->max));
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05

        User::insert([
            [
                'id' => 1,
<<<<<<< HEAD
                'uuid' => $this->generateUuid(),
=======
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
                'indicator_id' => null,
                'username' => 'superuser',
                'email' => 'morenwm@gmail.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('m0r3N111'),
                'status' => $status->active,
<<<<<<< HEAD
                //'access_profile' => $access_profile->superuser,
                'active_at' => $activeIn,
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
            ],
            [
                'id' => 2,
                'uuid' => $this->generateUuid(),
=======
                'access_profile' => $access_profile->superuser,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 2,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
                'indicator_id' => null,
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('&a5yeeex'),
                'status' => $status->active,
<<<<<<< HEAD
                //'access_profile' => $access_profile->admin,
                'active_at' => $activeIn,
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
            ],
            [
                'id' => 3,
                'uuid' => $this->generateUuid(),
=======
                'access_profile' => $access_profile->admin,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 3,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
                'indicator_id' => null,
                'username' => $root,
                'email' => $root . '@root.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make($root),
                'status' => $status->active,
<<<<<<< HEAD
                //'access_profile' => $access_profile->root,
                'active_at' => $activeIn,
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
            ],
            [
                'id' => 4,
                'uuid' => $this->generateUuid(),
=======
                'access_profile' => $access_profile->root,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
            ],
            [
                'id' => 4,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
                'indicator_id' => 3,
                'username' => 'brunas',
                'email' => 'brunasouza@tester.com',
                'email_verified_at' => $activeIn,
                'password' => \Illuminate\Support\Facades\Hash::make('teste123'),
                'status' => $status->active,
<<<<<<< HEAD
                //'access_profile' => $access_profile->member,
                'active_at' => $activeIn,
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
=======
                'access_profile' => $access_profile->member,
                'active_at' => $activeIn,
                'created_at' => $createdIn,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            ],
        ]);
    }
}
