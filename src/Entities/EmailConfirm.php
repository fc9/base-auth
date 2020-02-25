<?php

namespace Fc9\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailConfirm extends Model
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'email_confirm';

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

        dispatch(new \Fc9\Auth\Jobs\EmailConfirmJob($email, $token));
    }
}
