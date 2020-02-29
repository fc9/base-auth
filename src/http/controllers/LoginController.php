<?php

namespace Fc9\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Fc9\Auth\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @param \Fc9\Auth\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password') + ['status' => config('register.user.status.active')];
        if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        }

        if (auth()->attempt($credentials, $request->get('remember') === 'on')) {
            if (auth()->user()->email_verified_at === null) {
                return redirect()->route('signup.confirm');
            }
            return redirect()->route('dashboard.home', ['username' => auth()->user()->username]);
        }
        return redirect()->back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors(['username' => __('auth.failed'),]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
