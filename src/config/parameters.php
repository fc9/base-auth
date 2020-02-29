<?php

return [
    'user' => [
        'status' => [ #inUse
            'active' => 'Active',
            'locked' => 'Locked',
            'canceled' => 'Canceled',
            'inactive' => 'Inactive',
        ],

        'access_profile' => [ #inUse
            'partner' => 'Partner',
            'member' => 'Member',
            'support' => 'Support',
            'attendance' => 'Attendance',
            'manager' => 'Manager',
            'root' => 'Root',
            'admin' => 'Admin',
            'superuser' => 'Superuser',
        ],
    ],

    'person' => [
        'type' => [ #inUse
            'physical' => 'Physical',
            'artificial' => 'Artificial',
            'juridical' => 'Juridical',
        ],
    ],

    'address' => [
        'type' => [ #inUse
            'primary' => 'Primary',
            'business' => 'Business',
            'billing' => 'Billing',
            'delivery' => 'Delivery',
        ],
    ],

    'membership' => [
        'contract_read' => [ #inUse
            'no' => 'no',
            'yes' => 'yes',
        ],

        'graduate' => [ #inUse
            'partner' => 'Partner',
            'member' => 'Member',
            '1_star' => '1 Star',
            '2_star' => '2 Star',
            '3_star' => '3 Star',
            'manager' => 'Manager',
            'manager_25k' => 'Manager 25K',
            'manager_50k' => 'Manager 50K',
            'director_100k' => 'Director 100K',
            'director_250k' => 'Director 250K',
            'director_500k' => 'Director 500K',
            'millionaire_1m' => 'Millionaire 1M',
            'millionaire_25m' => 'Millionaire 2.5M',
            'millionaire_5m' => 'Millionaire 5M',
            'chairman_10m' => 'Chairman 10M',
            'chairman_25m' => 'Chairman 25M',
            'chairman_50m' => 'Chairman 50M',
        ],

        'status' => [ #inUse
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],

        'default_company_id' => 3,
    ],
];
