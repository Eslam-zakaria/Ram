<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Doctor\\Controllers\\';

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/doctors', 'DoctorController@index')->name('api.doctors.index');
    Route::get('/doctors/{doctor}/working_hours', 'DoctorController@findDoctorAvailableTimes')->name('api.doctors.working.hours');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('doctors', 'DoctorController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/doctors/{doctor}/disable', 'DoctorController@disable')->name('doctors.disable');
    Route::get('/doctors/{doctor}/enable', 'DoctorController@enable')->name('doctors.enable');
    Route::get('/ajax-BranchByCountryId', 'DoctorController@BranchAjax');
    Route::get('/ajax-SpecificityById', 'DoctorController@SpecificityAjax');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('list/doctors', 'DoctorController@index')->name('web.doctors.index');
    Route::get('doctors/{slug?}', 'DoctorController@details')->name('web.doctors.details');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/doctors/list', 'DoctorController@list')->name('api.doctors.list');
});
