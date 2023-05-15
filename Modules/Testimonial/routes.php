<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Testimonial\\Controllers\\';

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/testimonials', 'TestimonialController@index')->name('api.testimonials.index');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('testimonials', 'TestimonialController')->only('index', 'create', 'store');

    Route::get('/testimonials/{testimonial}/edit', 'TestimonialController@edit')->name('testimonials.edit');
    Route::PUT('/testimonials/{testimonial}', 'TestimonialController@update')->name('testimonials.update');
    Route::get('/testimonials/{testimonial}/disable', 'TestimonialController@disable')->name('testimonials.disable');
    Route::get('/testimonials/{testimonial}/enable', 'TestimonialController@enable')->name('testimonials.enable');
});
