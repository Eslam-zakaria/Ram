<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Page\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/pages', 'PageController@index')->name('api.pages.index');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('pages', 'PageController')->only('index', 'create', 'store');
    Route::get('/pages/{page}/edit', 'PageController@edit')->name('pages.edit');
    Route::PUT('/pages/{page}', 'PageController@update')->name('pages.update');
    Route::get('/pages/{page}/disable', 'PageController@disable')->name('pages.disable');
    Route::get('/pages/{page}/enable', 'PageController@enable')->name('pages.enable');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::post('page/contact', 'PageController@store')->name('web.pages.store');
    Route::get('/jcia', 'PageController@jcia')->name('web.pages.jcia');
    Route::get('page/thanks', 'PageController@thanks')->name('web.pages.thanks');
    Route::get('page/bh-thanks', 'PageController@bhThanks')->name('web.bh.pages.thanks');
    Route::get('page/{slug}', 'PageController@index')->name('web.pages.index');
});
