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
            'username' => config('auth::validation.rules.username_login'),
            'password' => config('auth::validation.rules.password'),
        ];
    }
}
