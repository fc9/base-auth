<?php

namespace Fc9\Auth\Http\Requests;

use Fc9\Api\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

abstract class AbstractApiFormRequest extends FormRequest
{
    use SanitizesInput;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * @return mixed
     */
    abstract public function filters();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * For more sanitizer rule check https://github.com/Waavi/Sanitizer
     */
    public function validateResolved()
    {
        {
            $this->sanitize();
            parent::validateResolved();
        }
    }
}
