<?php

namespace Fc9\Auth\Entities;

use Laravel\Passport\RefreshToken as PassportRefreshToken;

class RefreshToken extends PassportRefreshToken
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'refresh_token';
}