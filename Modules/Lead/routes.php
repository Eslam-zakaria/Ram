<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Lead\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/leads', 'LeadController@index')->name('api.leads.index');
});


Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('leads', 'LeadController')->only('index', 'edit', 'update');
    Route::get('/leads/{lead}/confirmed', 'LeadController@confirmed')->name('leads.confirmed');
    Route::get('/leads/{lead}/unconfirmed', 'LeadController@unconfirmed')->name('leads.unconfirmed');
    Route::get('/leads/{lead}/winner', 'LeadController@winner')->name('leads.winner');
    Route::get('/export-leads', 'LeadController@exportCsv')->name('leads.export');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::post('/leads', 'LeadController@store')->name('api.leads.store');
});


Route::prefix('/')->attribute('namespace', $namespace.'Web')->group( function () {
    Route::get('page/installment', 'LeadController@index')->middleware('language')->name('web.leads.index');
    Route::post('page/installment', 'LeadController@store')->middleware('language')->name('web.leads.store');
    Route::get('page/installment-thanks', 'LeadController@confirm')->middleware('language')->name('web.leads.thanks');
    //==========Free-Services================
    Route::get('page/free-services', 'LeadController@freeservices')->middleware('language')->name('web.leads.freeservices');
    Route::post('page/store-free-services', 'LeadController@storefreeservices')->middleware('language')->name('web.leads.store-free');
    Route::get('page/free-services-thanks', 'LeadController@thanksfreeservices')->middleware('language')->name('web.leads.freethanks');

    //==========Rate================
    Route::get('/page/rate', 'LeadController@rate')->middleware('language')->name('web.leads.rate');
    Route::post('/store/rate', 'LeadController@storerate')->middleware('language')->name('web.leads.store-rate');
    Route::get('/rate/thanks', 'LeadController@thanksrate')->middleware('language')->name('web.leads.ratethanks');
});
