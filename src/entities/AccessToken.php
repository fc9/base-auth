<?php

namespace Fc9\Auth\Entities;

use Laravel\Passport\Token as PassportToken;

class AccessToken extends PassportToken
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'access_token';
}