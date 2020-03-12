<?php

namespace Fc9\Auth\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;

class CheckEmailRequest extends AbstractFormRequest
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
            'indicator' => config('auth::validation.filters.indicator'),
            'email' => config('auth::validation.filters.email'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $indicator_rules = explode('|', config('auth::validation.rules.indicator_check'));
        $indicator_rules[] = new \Fc9\Auth\Rules\Qualified;
        //$pattern = config('auth::validation.pattern.username');

        return [
            'indicator' => $indicator_rules,
            //'indicator' => ['bail', 'required', 'min:5', 'max:16', 'regex:' . $pattern, new Qualified()],
            'agree_to_terms' => config('auth::validation.rules.agree_to_terms'),
            'email' => config('auth::validation.rules.email'),
        ];
    }
}
