<?php

return [

    'filters' => [
        'address' => '',
        'age' => '',
        'agree_to_terms' => '',
        'avatar' => '',
        'birth_date' => '',
        'body' => '',
        'city' => '',
        'complement' => '',
        'country' => 'trim|escape|uppercase',
        'date' => '',
        'day' => '',
        'description' => '',
        'email' => 'trim|lowercase',
        'excerpt' => '',
        'first_name' => 'trim|escape|lowercase|capitalize',
        'gender' => '',
        'hour' => '',
        'indicator' => 'trim|capitalize|escape|lowercase',
        'last_name' => 'trim|escape|lowercase|capitalize',
        'message' => '',
        'minute' => '',
        'mobile' => '',
        'month' => '',
        'name' => '',
        'number' => '',
        'password' => 'trim',
        'password_confirm' => '',
        'phone' => 'trim',
        'remember' => '',
        'second' => '',
        'sector' => '',
        'sex' => '',
        'state' => '',
        'street' => '',
        'subject' => '',
        'text' => '',
        'time' => '',
        'title' => '',
        'token' => 'trim|escape|uppercase',
        'username' => 'trim|escape|lowercase',
        'year' => '',
        'zip_code' => '',
    ],

    'rules' => [
        'address' => '',
        'age' => '',
        'agree_to_terms' => 'accepted',
        'avatar' => 'max:45|string',
        'birth_date' => '',
        'body' => '',
        'city' => '',
        'complement' => 'max:16|string',
        'country' => '',
        'country_code' => 'required|max:2',
        'date' => '',
        'day' => '',
        'description' => '',
        'email' => 'bail|required|max:90|email|unique:user',
        'excerpt' => '',
        'first_name' => 'required|min:3|max:18|string',
        'gender' => '',
        'hour' => '',
        'indicator' => 'bail|required|min:4|max:16|string|regex:/[0-9a-zA-Z._]+/|exists:user,username',
        'last_name' => 'min:3|max:45|string',
        'message' => '',
        'minute' => '',
        'mobile' => '',
        'month' => '',
        'name' => '',
        'number' => 'max:10',
        'password' => 'bail|required|min:8|max:24|string',
        'password_confirm' => '',
        'phone' => 'required|min:7|max:15',
        'remember' => '',
        'second' => '',
        'sector' => 'max:16',
        'sex' => '',
        'state' => '',
        'street' => 'max:18',
        'subject' => '',
        'text' => '',
        'time' => '',
        'title' => '',
        'token' => 'bail|size:60|string|exists:email_confirm',
        'username' => 'bail|required|min:4|max:16|string|regex:/^(?![_.])(?!.*[_.]{2})[a-z0-9._]+(?<![_.])$/|exists:user',
        'year' => '',
        'zip_code' => 'max:16',
    ],

    'pattern' => [
        # For username:
        # Number of characters must be between 6 to 18.
        # Underscore and dot can't be at the end or start of a username (e.g _username_, .username, username.).
        # Underscore or dot can't be used multiple times in a row (e.g user__name / user..name).
        # Only contains alphanumeric characters, underscore and dot.
        # Underscore and dot can't be next to each other (e.g user_.name).
        'username' => '/^(?=.{6,18}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/',

        'route' => [
            'locale' => '[a-z\-A-Z]+',
            'username' => '[0-9a-zA-Z._]+',
        ],
    ],

];
