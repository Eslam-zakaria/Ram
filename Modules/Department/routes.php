<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Department\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('departments', 'DepartmentController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/departments/{department}/delete', 'DepartmentController@deleted')->name('departments.delete');
});


Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/departments', 'DepartmentController@index')->name('api.departments.index');
});

