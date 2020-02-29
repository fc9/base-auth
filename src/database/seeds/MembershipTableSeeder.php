<?php

namespace Fc9\Auth\Database\Seeders;

use Fc9\Auth\entities\Membership;
use Illuminate\Database\Seeder;

class MembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership = config('auth::parameters.membership');
        $contract_read = improve($membership['contract_read']);
        $graduate = improve($membership['graduate']);
        $status = improve($membership['status']);
        unset($membership);

        $createdIn = date('Y/m/d H:i:s');

        Membership::insert([
//            [
//                'company_id' => null,
//                'person_id' => 1,
//                'contract_read' => $contract_read->no,
//                'graduate' => $graduate->?,
//                'status' => $status->inactive,
//                'created_at' => $createdIn,
//            ],

//            [
//                'company_id' => null,
//                'person_id' => 2,
//                'contract_read' => $contract_read->no,
//                'graduate' => $graduate->?,
//                'status' => $status->inactive,
//                'created_at' => $createdIn,
//            ],

            [
                'company_id' => null,
                'person_id' => 3,
                'contract_read' => $contract_read->yes,
                'graduate' => $graduate->member,
                'status' => $status->active,
                'created_at' => $createdIn,
            ],

            [
                'company_id' => 3, #default
                'person_id' => 4,
                'contract_read' => $contract_read->yes,
                'graduate' => $graduate->member,
                'status' => $status->active,
                'created_at' => $createdIn,
            ],
        ]);
    }
}
