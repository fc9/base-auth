<?php

return [

    'service' => [
        'status' => [
            'not_available',
            'updating',
            'maintenance',
            'available',
        ],
    ],

    'uploads' => [
        'profile' => 'uploads/profile/',
    ],

    'api' => [
        'clients' => [
            [
                'type' => 'personal',
                'id' => 1,
                'secret' => 'q4tkNnW11KbLbO49YGCA7jd330pTRxzsS4DmGe0G',
                // Tokens não expiram.
            ],

            [
                'type' => 'password',
                'id' => 2,
                'secret' => 'kX0kIL1yLnN9dnYgCKjTpTsnejQQWNMZG6HPecWD',
            ],
        ],
    ],
];
