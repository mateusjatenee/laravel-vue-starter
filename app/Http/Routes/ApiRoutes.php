<?php

Route::group(['middleware' => 'api', 'prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::post('auth/register', 'AuthController@register');
});
