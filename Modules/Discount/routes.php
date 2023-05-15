<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Discount\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('discounts', 'DiscountController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/discounts/{discount}/disable', 'DiscountController@disable')->name('discounts.disable');
    Route::get('/discounts/{discount}/enable', 'DiscountController@enable')->name('discounts.enable');


        //=================Discount-bookins===================
        Route::resource('discounts-bookings', 'DiscountBookingController')->only('index', 'edit', 'update');
        Route::get('/export-discounts-bookings', 'DiscountBookingController@exportCsv')->name('discounts-bookings.export');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('cards', 'CardController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/cards/{card}/disable', 'CardController@disable')->name('cards.disable');
    Route::get('/cards/{card}/enable', 'CardController@enable')->name('cards.enable');

});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('discount-categories', 'DiscountCategoryController')->only('index', 'edit', 'update', 'create', 'store');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/discounts', 'DiscountController@index')->name('api.discounts.index');
});
Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/discount-categories', 'CategoryController@index')->name('api.discount.categories.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/discount-bookings', 'BookingController@index')->name('api.discount-bookings.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/cards', 'CardController@index')->name('api.cards.index');
});

Route::prefix('/')->attribute('namespace', $namespace.'Web')->group( function () {
    Route::get('/validate-available-booking', 'DiscountController@validateAvailableBooking')->name('web.discount-booking.check.availability');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('page/discounts-cards', 'DiscountController@index')->name('web.discounts.index');
    Route::get('page/discounts-cards/{card}', 'DiscountController@details')->name('web.discounts.details');
    Route::get('page/discounts-book/{id?}', 'DiscountController@bookdiscount')->name('web.discounts.book');
    Route::post('page/discounts-book-store/{lang?}', 'DiscountController@store')->name('web.discount-booking.store');
    Route::get('page/discounts-confirm/{id}', 'DiscountController@confirm')->name('web.discount-booking.confirm');
});
