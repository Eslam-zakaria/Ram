<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Ticket\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/tickets', 'TicketController@index')->name('api.tickets.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('tickets', 'TicketController')->only('index', 'edit', 'update');
    Route::get('/export-tickets', 'TicketController@exportCsv')->name('tickets.export');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::post('/tickets', 'TicketController@store')->name('api.tickets.store');
});
