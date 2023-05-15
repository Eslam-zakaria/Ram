<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Modules\\Blog\\Controllers\\';

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('blogs', 'BlogController')->only('index', 'edit', 'update', 'create', 'store');
    Route::get('/blogs/{blog}/disable', 'BlogController@disable')->name('blogs.disable');
    Route::get('/blogs/{blog}/enable', 'BlogController@enable')->name('blogs.enable');
});

Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', $namespace.'Admin')->as('admin.')->group( function () {
    Route::resource('blog-categories', 'BlogCategoryController')->only('index', 'edit', 'update', 'create', 'store');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/blogs', 'BlogController@index')->name('api.blogs.index');
});

Route::prefix('/api')->middleware('auth:web')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/blog-categories', 'CategoryController@index')->name('api.blog.categories.index');
});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}'], 'namespace' => $namespace.'Web'], function () {
    Route::post('/advices/comment', 'BlogController@comment')->name('web.advices.comment');
});

Route::prefix('/api')->attribute('namespace', $namespace.'Api')->group( function () {
    Route::get('/blogs/list', 'BlogController@list')->name('api.blogs.list');
});
