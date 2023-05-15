<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Video\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/videos', 'VideoController@index')->name('api.videos.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('videos', 'VideoController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/videos/{video}/disable', 'VideoController@disable')->name('videos.disable');
    Route::get('/videos/{video}/enable', 'VideoController@enable')->name('videos.enable');
    Route::get('/videos/{video}/delete', 'VideoController@deleted')->name('videos.delete');
});
