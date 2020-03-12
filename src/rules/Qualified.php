<?php

namespace Fc9\Auth\Rules;

use Illuminate\Contracts\Validation\Rule;
<<<<<<< HEAD
use Fc9\Auth\Entities\UserView;
=======
use Modules\Register\Entities\UserView;
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05

class Qualified implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
<<<<<<< HEAD
=======
        //
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return UserView::where('username', $value)
<<<<<<< HEAD
            ->where('user_status', improve(config('auth::parameters.status'))->active)
            ->where('membership_status', improve(config('auth::parameters.membership.status'))->active)
            ->where('graduate', '!=', improve(config('auth::parameters.membership.graduate'))->partner)
=======
            ->where('user_status', config('register.user.status.active'))
            ->where('membership_status', config('register.membership.status.active'))
            ->where('graduate', '!=', config('register.membership.graduate.partner'))
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute not found or unqualified.';
    }
}
