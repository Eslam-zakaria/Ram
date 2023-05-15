<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Partner\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/partners', 'PartnerController@index')->name('api.partners.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('partners', 'PartnerController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/partners/{partner}/disable', 'PartnerController@disable')->name('partners.disable');
    Route::get('/partners/{partner}/enable', 'PartnerController@enable')->name('partners.enable');
});

