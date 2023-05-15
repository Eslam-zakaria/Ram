<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Branche\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/branches', 'BrancheController@index')->name('api.branches.index');
});


Route::prefix('{lang}/api')->middleware('language')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/branches/specificities/{branche}', 'BrancheController@listSpecialtiesbyBrnache')->name('api.branches.specificities');
    Route::get('/branchesByservices/{service}', 'BrancheController@listBrnacheByServices')->name('api.branches.services');
});
Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('branches', 'BrancheController')->only('index', 'create', 'store');

    Route::get('/branches/{branche}/edit', 'BrancheController@edit')->name('branches.edit');
    Route::PUT('/branches/{branche}', 'BrancheController@update')->name('branches.update');
    Route::get('/branches/{branche}/disable', 'BrancheController@disable')->name('branches.disable');
    Route::get('/branches/{branche}/enable', 'BrancheController@enable')->name('branches.enable');
    Route::get('/branches/{branche}/delete', 'BrancheController@delete')->name('branches.delete');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('list/branches/', 'BrancheController@index')->name('web.branches.index');
});

Route::prefix('{lang}/api')->middleware('language')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/branches/doctors/{service}/{branche}', 'BrancheController@listDoctorsByBranche')->name('api.branches.doctors');
});
