<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Service\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/services', 'ServiceController@index')->name('api.services.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('services', 'ServiceController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/services/{service}/disable', 'ServiceController@disable')->name('services.disable');
    Route::get('/services/{service}/enable', 'ServiceController@enable')->name('services.enable');
    Route::get('/services/{service}/delete', 'ServiceController@deleted')->name('services.delete');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('/service/{slug?}', 'ServiceController@subServicesdetails')->name('web.subservices.details');
});

Route::prefix('{lang}/api')->middleware('language')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/specificitiesByServices/{service}', 'ServiceController@listSpecificitiesByServices')->name('api.services.specificities');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/services/list', 'ServiceController@list')->name('api.services.list');
});
