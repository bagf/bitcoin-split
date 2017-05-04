<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::get('/', 'AuthController@getLanding');
    Route::get('user/change_password', 'UserController@getChangePassword');
    Route::post('user/change_password', 'UserController@postChangePassword');

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');

    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');

    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegisterFirst');

    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::post('user/create', 'UserController@save');
    Route::get('user/{user}', 'UserController@view');
    Route::post('user/{user}', 'UserController@update');
    Route::post('user/{user}/delete', 'UserController@delete');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('clientsplit', 'ClientSplitController@index');
    Route::get('clientsplit/create', 'ClientSplitController@create');
    Route::post('clientsplit/create', 'ClientSplitController@save');
    Route::get('clientsplit/{clientSplit}', 'ClientSplitController@view');
    Route::post('clientsplit/{clientSplit}', 'ClientSplitController@update');
    Route::post('clientsplit/{clientSplit}/delete', 'ClientSplitController@delete');
});