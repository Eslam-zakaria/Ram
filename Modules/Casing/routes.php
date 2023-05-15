<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Casing\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('Casings', 'CasingController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/Casings/{Casing}/disable', 'CasingController@disable')->name('Casings.disable');
    Route::get('/Casings/{Casing}/enable', 'CasingController@enable')->name('Casings.enable');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('Casing-categories', 'CasingCategoryController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/Casing-categories/{CasingCategory}/delete', 'CasingCategoryController@deleted')->name('Casing-categories.delete');

});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/Casings', 'CasingController@index')->name('api.Casings.index');
});
Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/Casing-categories', 'CategoryController@index')->name('api.Casing.categories.index');
});


Route::group(['prefix' => '{locale?}', 'middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('/cases', 'CasingController@index')->name('web.Casings.index');
});