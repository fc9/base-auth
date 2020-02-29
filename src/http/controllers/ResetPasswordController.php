<?php

namespace Fc9\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = \Fc9\Auth\providers\RouteServiceProvider::HOME;
}
