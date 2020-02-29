<?php

namespace Fc9\Auth\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;
use Fc9\Auth\Rules\Qualified;

class RegisterRequest extends AbstractFormRequest
{
    use SanitizesInput;

    /**App\
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
            'indicator' => config('auth::validation.filters.indicator'),
            'email' => config('auth::validation.filters.email'),
            'first_name' => config('auth::validation.filters.first_name'),
            'last_name' => config('auth::validation.filters.last_name'),
            'username' => config('auth::validation.filters.username'),
            'password' => config('auth::validation.filters.password'),
            'country' => config('auth::validation.filters.country'),
            'phone' => config('auth::validation.filters.phone'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $indicator_rules = explode('|', config('auth::validation.rules.indicator_register'));
        $indicator_rules[] = new \Fc9\Auth\Rules\Qualified;

        //$pattern = config('register.pattern.username');

        return [
            //'indicator' => ['bail', 'required', 'min:5', 'max:18', 'regex:' . $pattern, new Qualified()],
            'indicator' => $indicator_rules,
            'email' => config('auth::validation.rules.email'),
            'first_name' => config('auth::validation.rules.first_name'),
            'last_name' => config('auth::validation.rules.last_name'),
            'username' => config('auth::validation.rules.username_register'),
            'password' => config('auth::validation.rules.password'),
            'country' => config('auth::validation.rules.country_code'),
            'phone' => config('auth::validation.rules.phone'),
        ];
    }
}
