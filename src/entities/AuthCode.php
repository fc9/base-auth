<?php

namespace Fc9\Auth\Entities;

use Laravel\Passport\AuthCode as PassportAuthCode;

class AuthCode extends PassportAuthCode
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'auth_code';
}