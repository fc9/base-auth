<?php

namespace Fc9\Auth\Database\Seeders;

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
        $this->call(UserTableSeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(MembershipTableSeeder::class);
    }
}
