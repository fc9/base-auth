<?php

namespace Fc9\Auth\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;

class EmailConfirmRequest extends AbstractFormRequest
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
            'token' => config('auth::validation.filters.token'),
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
            'token' => config('auth::validation.rules.token'),
        ];
    }
}
