<?php

namespace Fc9\Auth\Http\Controllers\SignUp;

use Fc9\Auth\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Fc9\Auth\Http\Requests\EmailConfirmRequest;
use Fc9\Auth\Entities\EmailConfirm;
use Illuminate\Support\Str;

class ConfirmEmailController extends Controller
{
    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = \Fc9\Auth\Providers\RouteServiceProvider::HOME;

    public function sendConfirmLink()
    {
        $email = Session::get('email');
        EmailConfirm::sendLink($email);

        return View::make('auth::signup.sended_confirm_email', ['email' => EmailConfirm::fogUp($email)]);
    }

    public function confirm(EmailConfirmRequest $request)
    {
        $user = auth()->user();
        EmailConfirm::destroy($user->email);

        $this->sendConfirmRegister($user->email, $user->username, $user->first_name);
        $this->sendConfirmIndication($user);

        $now = date('Y-m-d H:i:s');
        $user = auth()->user();
        $user->status = config('auth::parameters.user.status.active');
        $user->active_at = $now;
        $user->email_verified_at = $now;
        $user->save();

        return redirect()->route('shop.home', ['username' => auth()->user()->username]);
    }

    private function sendConfirmationLink($email)
    {
        $token = Str::upper(Str::random(5));
        EmailConfirm::destroy($email);
        EmailConfirm::create(compact('email', 'token'));

        dispatch(new \Fc9\Auth\Jobs\ConfirmEmailJob($email, $name, $token));
    }

    public function sendConfirmRegister($email, $username, $name)
    {
        dispatch(new \Fc9\Auth\Jobs\SendMailConfirmRegisterJob($email, $username, $name));
    }

    public function sendConfirmIndication($user)
    {
        //$indicator = $user->indicator();
        //dd($indicator);
        $indicator = User::find($user->indicator_id);

        dispatch(new \Fc9\Auth\Jobs\SendMailConfirmIndicationJob($indicator->email, $indicator->name, $user->username));
    }
}
