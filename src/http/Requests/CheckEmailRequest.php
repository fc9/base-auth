<?php

namespace Fc9\Auth\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;
use Fc9\Auth\Rules\Qualified;

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
            'indicator' => 'trim|capitalize|escape|lowercase',
            'email' => 'trim|lowercase',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $pattern = config('register.pattern.username');

        return [
            'indicator' => ['bail', 'required', 'min:5', 'max:18', 'regex:' . $pattern, new Qualified()],
            'email' => 'bail|required|max:90|email|unique:user',
        ];
    }
}
