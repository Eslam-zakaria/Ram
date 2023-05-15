<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Booking\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/bookings', 'BookingController@index')->name('api.bookings.index');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('bookings', 'BookingController')->only('index', 'edit', 'update');
    Route::get('/export-bookings', 'BookingController@exportCsv')->name('bookings.export');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::post('/bookings', 'BookingController@store')->name('api.bookings.store');
});


Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::post('/store', 'BookingController@store')->name('web.booking.store');
    Route::get('/confirm/{id}', 'BookingController@confirm')->name('web.bookings.confirm');
});

Route::prefix('/')->attribute('namespace', $namespace.'Web')->group( function () {
    
    Route::get('/validate-available-booking', 'BookingController@validateAvailableBooking')->name('web.booking.check.availability');
});
