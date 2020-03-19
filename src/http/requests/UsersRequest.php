<?php

namespace Fc9\Auth\Http\Requests;

class UsersRequest extends AbstractApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @inheritDoc
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function filters()
    {
        $filters = config('auth::validation.filters');

        return [
            'indicator' => $filters['indicator'],
            'email' => $filters['email'],
            'first_name' => $filters['first_name'],
            'last_name' => $filters['last_name'],
            'username' => $filters['username'],
            'password' => $filters['password'],
            //'country' => $filters['country'],
            'phone' => $filters['phone'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        $rules = config('auth::validation.rules');

        return [
            'indicator' => explode('|', $rules['indicator_register']) + [10 => new \Fc9\Auth\Rules\Qualified], //TODO: serializar
            'email' => $rules['email'],
            'first_name' => $rules['first_name'],
            'last_name' => $rules['last_name'],
            'username' => $rules['username_register'],
            'password' => $rules['password'],
            'country' => $rules['country_code'],
            'phone' => $rules['phone'],
        ];
    }
}