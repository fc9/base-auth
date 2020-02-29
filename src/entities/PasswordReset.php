<?php

namespace Fc9\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PasswordReset extends Model
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'password_reset';

    public $primaryKey = 'email';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
    ];

    public static function sendToken($email)
    {
        $token = Str::upper(Str::random(5));

        self::destroy($email);
        self::create(compact('email', 'token'));

        dispatch(new \Fc9\Auth\Jobs\SendMailPasswordReset($email, $token));
    }

    public static function cloudMail($email)
    {
        $rouse = strpos($email, '@');
        $dot = strpos($email, '.');
        return substr($email, 0, 3) .
            str_repeat('*', $rouse - 4) .
            substr($email, $rouse, 3) .
            str_repeat('*', $dot - ($rouse + 3)) .
            substr($email, $dot);
    }
}
