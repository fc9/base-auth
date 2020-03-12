<?php

namespace Fc9\Auth\Http\Middlewares;

use Closure;
use App\Http\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;
<<<<<<< HEAD
use Fc9\Auth\Entities\UserView;
=======
use Fc9\Auth\entities\UserView;
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->setSessionUser($request->route('username'));

        $this->authenticate($request, $guards);
        return $next($request);
    }

    /**
     * I defined the session user using the username route parameter, if authenticated.
     *
     * @param $username
     */
    private function setSessionUser($username)
    {
        if ($this->auth->check()) {
            $user = $this->getAllowedUser($username);

            $user->himself = $user['id'] === $this->auth->user()->id;
<<<<<<< HEAD
=======
            $user->avatar = config('auth.person.avatar.path') . $user->avatar;
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05

            Session::put('user', $user);
        }
    }

    /**
     * Obtain a user whose access is allowed to the authenticated user.
     *
     * @param $username
     * @return mixed
     */
    private function getAllowedUser($username)
    {
        if ($username === $this->auth->user()->username) {
<<<<<<< HEAD
            return UserView::find($this->auth->user()->id);
        }

        $user = UserView::where('username', $username)->first();
        if ($user === null || $user->access_profile === config('auth::parameters.user.access_profile.superuser')) {
            return UserView::find($this->auth->user()->id);
        }

        return ($this->auth->user()->access_profile !== config('auth::parameters.user.access_profile.superuser') &&
            $this->auth->user()->access_profile !== config('auth::parameters.user.access_profile.admin'))
=======
            return UserView::find(auth()->user()->id);
        }

        $user = UserView::where('username', $username)->first();
        if ($user === null || $user->access_profile === config('auth.user.access_profile.superuser')) {
            return UserView::find($this->auth->user()->id);
        }

        return ($this->auth->user()->access_profile !== config('auth.user.access_profile.superuser') &&
            $this->auth->user()->access_profile !== config('auth.user.access_profile.admin'))
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            ? UserView::find($this->auth->user()->id)
            : $user;
    }

}