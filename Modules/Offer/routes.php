<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Offer\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/offers', 'OfferController@index')->name('api.offers.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/offer-branches', 'BrancheController@index')->name('api.offer.branches.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/offer-bookings', 'BookingController@index')->name('api.offer-bookings.index');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('offer-branches', 'OfferBrancheController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/offer-branches/{offerBranche}/disable', 'OfferBrancheController@disable')->name('offer-branches.disable');
    Route::get('/offer-branches/{offerBranche}/enable', 'OfferBrancheController@enable')->name('offer-branches.enable');

    //=================offer-bookins===================
    Route::resource('offer-bookings', 'OfferBookingController')->only('index', 'edit', 'update');
    Route::get('/export-offer-bookings', 'OfferBookingController@exportCsv')->name('offer-bookings.export');

});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::get('page/offers', 'OfferController@index')->name('web.offers.index');
    Route::get('page/offers/{slug?}', 'OfferController@lists')->name('web.offers.lists');
    Route::get('page/offer-book/{id?}', 'OfferController@bookoffer')->name('web.offers.book');
    Route::post('page/offer-book-store', 'OfferController@store')->name('web.offer-booking.store');
    Route::get('page/payment/{referal_code?}', 'OfferController@payment')->name('web.bookings.payment');
    Route::any('page/offer-thanks', 'OfferController@thanks')->name('web.offers.thanks');
    Route::get('page/payment/type', 'OfferController@Installmenttamara')->name('web.payment.type');
    Route::any('page/offer-installment', 'OfferController@offerInstallment')->name('web.offers.installment');
    Route::any('page/offer/installment-thanks', 'OfferController@thanksInstallment')->name('web.offers.installment.thanks');
    Route::get('offers/terms-and-conditions', 'OfferController@terms')->name('web.offers.terms');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('offers', 'OfferController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/offers/{offer}/disable', 'OfferController@disable')->name('offers.disable');
    Route::get('/offers/{offer}/enable', 'OfferController@enable')->name('offers.enable');
});

