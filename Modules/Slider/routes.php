<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Slider\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/sliders', 'SliderController@index')->name('api.sliders.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('sliders', 'SliderController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/sliders/{slider}/disable', 'SliderController@disable')->name('sliders.disable');
    Route::get('/sliders/{slider}/enable', 'SliderController@enable')->name('sliders.enable');
});
