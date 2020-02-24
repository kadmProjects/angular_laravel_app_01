<?php

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::group(['middleware' => ['auth.header', 'auth:api', 'verify.csrf']], function() {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('loginStatus', 'Auth\CheckAuthStatusController@loginStatus')->name('loginStatus');
    //Route::
});
