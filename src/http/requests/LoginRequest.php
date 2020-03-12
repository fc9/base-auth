<?php

namespace Fc9\Auth\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;

class LoginRequest extends AbstractFormRequest
{
    use SanitizesInput;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'username' => config('auth::validation.filters.username'),
            'password' => config('auth::validation.filters.password'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            'username' => config('auth::validation.rules.username'),
=======
            'username' => config('auth::validation.rules.username_login'),
>>>>>>> b8e2c823efe0dba6ba5da102ca26ea3adc11bc05
            'password' => config('auth::validation.rules.password'),
        ];
    }
}
