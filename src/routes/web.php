<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::group(['prefix' => 'auth', 'as' => 'auth'], function () {
//    Route::get('/', 'AuthController@index');
//});

Route::group(['middleware' => 'guest'], function () {

    # Log In Routes
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->exchangeMiddleware('auth')->name('logout');
    Route::get('invitation/{indicator}', 'CheckEmailController@showCheckForm');

    # Log Up Routes
    Route::group(['prefix' => 'signup', 'as' => 'signup'], function () {
        # Step 1
        Route::get('/', 'CheckEmailController@showCheckForm')->name('.check');
        Route::post('/', 'CheckEmailController@check');
        # Step 2
        Route::get('register', 'RegisterController@showRegistrationForm')->name('.register');
        Route::post('register', 'RegisterController@register');
        # Step 3
        Route::get('confirm', 'EmailConfirmController@showConfirmForm')->exchangeMiddleware('auth')->name('.confirm');
        Route::post('confirm', 'EmailConfirmController@confirm')->exchangeMiddleware('auth');
    });

    # Confirm Password Routes
    Route::get('confirm/{token?}', 'ConfirmPasswordController@showConfirmForm')->name('.confirm');
    Route::post('confirm', 'ConfirmPasswordController@confirm');

    # Reset Password Routes
    Route::group(['prefix' => 'password', 'as' => 'password'], function () {
        Route::get('request', 'ForgotPasswordController@showLinkRequestForm')->name('.request');
        Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('.email');
        Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('.reset');
        Route::post('reset', 'ResetPasswordController@reset')->name('.update');
    });

});

Route::group(['prefix' => 'signup', 'as' => 'signup', 'middleware' => 'auth',], function () {
    # Step 3
    Route::get('confirm', 'EmailConfirmController@showConfirmForm')->name('.confirm');
    Route::post('confirm', 'EmailConfirmController@confirm');
});