<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Job\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/jobs', 'JobController@index')->name('api.jobs.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('jobs', 'JobController')->only('index', 'create', 'store');

    Route::get('/jobs/{job}/edit', 'JobController@edit')->name('jobs.edit');
    Route::PUT('/jobs/{job}', 'JobController@update')->name('jobs.update');
    Route::get('/jobs/{job}/disable', 'JobController@disable')->name('jobs.disable');
    Route::get('/jobs/{job}/enable', 'JobController@enable')->name('jobs.enable');
});


Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('/jobs/{job}', 'JobController@details')->name('web.jobs.details');
    Route::get('/jobs/{job}/apply', 'JobController@apply')->name('web.jobs.apply');
    Route::post('/jobs/apply', 'JobController@store')->name('web.jobs.store');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/job-requests', 'JobRequestController@index')->name('api.job.requests.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('job-requests', 'JobRequestController')->only('index', 'edit', 'update');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::post('/job-requests', 'JobRequestController@store')->name('api.job.requests.store');
});

