<?php

namespace Fc9\Auth\Database\Seeders;

use Fc9\Auth\entities\Person;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = improve(config('auth::parameters.person.type'));
<<<<<<< HEAD
        $datedIn = date('Y/m/d H:i:s');
=======
        $createdIn = date('Y/m/d H:i:s');
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05

        Person::insert([
//            [
//                'id' => 1,
//                'user_id' => 1,
//                'first_name' => 'More',
//                'last_name' => 'Marketing Network',
//                'birth_date' => null,
//                'type' => $type->juridical,
<<<<<<< HEAD
//                'created_at' => $datedIn,
//                'updated_at' => $datedIn,
=======
//                'created_at' => $createdIn,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
//            ],

//            [
//                'id' => 2,
//                'user_id' => 2,
//                'first_name' => 'Admin',
//                'last_name' => 'ADM',
//                'birth_date' => null,
//                'type' => $type->juridical,
<<<<<<< HEAD
//                'created_at' => $datedIn,
//                'updated_at' => $datedIn,
=======
//                'created_at' => $createdIn,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
//            ],

            [
                'id' => 3,
                'user_id' => 3,
                'first_name' => 'Company',
                'last_name' => 'Foundation',
                'birth_date' => null,
                'type' => $type->juridical,
<<<<<<< HEAD
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
=======
                'created_at' => $createdIn,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            ],

            [
                'id' => 4,
                'user_id' => 4,
                'first_name' => 'Bruna',
                'last_name' => 'Souza',
                //'birth_date' => date('Y/m/d H:i:s', strtotime('-18 years')),
                'birth_date' => \Faker\Provider\DateTime::date('Y/m/d H:i:s', '-18 years'),
                'type' => $type->artificial,
<<<<<<< HEAD
                'created_at' => $datedIn,
                'updated_at' => $datedIn,
=======
                'created_at' => $createdIn,
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            ],
        ]);

    }
}
