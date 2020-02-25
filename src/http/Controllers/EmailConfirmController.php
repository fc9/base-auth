<?php

namespace Fc9\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class EmailConfirmController extends Controller
{
    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = \Fc9\Auth\Providers\RouteServiceProvider::HOME;

    public function showConfirmForm()
    {
        \Fc9\Auth\Entities\EmailConfirm::sendToken(auth()->user()->email);

        return View::make('auth.confirm_email', ['step' => 3, 'email' => auth()->user()->email]);
    }

    public function confirm(\Fc9\Auth\Http\Requests\EmailConfirmRequest $request)
    {
        \Fc9\Auth\Entities\EmailConfirm::destroy(auth()->user()->email);

        $user = auth()->user();
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect()->route('dashboard.home', ['username' => auth()->user()->username]);
    }
}
