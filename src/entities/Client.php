<?php

namespace Fc9\Auth\Entities;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'client';
}