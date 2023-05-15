<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Specificity\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('specificities', 'SpecificityController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/specificities/{specificity}/disable', 'SpecificityController@disable')->name('specificities.disable');
    Route::get('/specificities/{specificity}/enable', 'SpecificityController@enable')->name('specificities.enable');
    Route::get('/specificities/{specificity}/delete', 'SpecificityController@delete')->name('specificities.delete');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('categories', 'CategoryController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/categories/{category}/disable', 'CategoryController@disable')->name('categories.disable');
    Route::get('/categories/{category}/enable', 'CategoryController@enable')->name('categories.enable');
    Route::get('/categories/{category}/delete', 'CategoryController@enable')->name('categories.delete');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/specificities', 'SpecificityController@index')->name('api.specificities.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/categories', 'CategoryController@index')->name('api.categories.index');
});


Route::group(['prefix' => '{locale?}', 'middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('/specialities', 'SpecificityController@index')->name('web.specialities.index');
});

Route::prefix('{lang}/api')->middleware('language')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/specificities/{specificity}', 'SpecificityController@show')->name('api.specificities.show');
    Route::get('/specificities/doctors/{service}/{branche}/{specificity}', 'SpecificityController@listDoctorsBySpecialty')->name('api.specificities.doctors');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/specificities/list', 'SpecificityController@list')->name('api.specificities.list');
});
