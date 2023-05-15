<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Country\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('countries', 'CountryController')->only('index', 'edit', 'update');
});


Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/countries', 'CountryController@index')->name('api.countries.index');
});
