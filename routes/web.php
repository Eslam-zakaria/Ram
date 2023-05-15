<?php

use App\Enums\PagesPathsEnums;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Routing\ControllerDispatcher;
use Illuminate\Support\Facades\Route;
use Modules\Blog\Controllers\Web\BlogController;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\BlogCategory;
use Modules\Service\Models\Service;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}']], function () {
        Route::get('/', 'HomeController@index')->name('web.home.index');
        Route::post('/post/subscribe', 'HomeController@subscribe')->name('web.home.subscribe');
        Route::get('/search/results', 'HomeController@search')->name('web.home.search');
    });

    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/pending/users', function () { return view('admin.dashboard.index'); })->name('admin.pending.users');
        Route::get('/pending/tickets', function () { return view('admin.dashboard.index'); })->name('admin.pending.tickets');
        Route::get('/transactions', function () { return view('admin.dashboard.index'); })->name('admin.transactions.index');
        Route::get('/notifications', function () { return view('admin.dashboard.index'); })->name('admin.notifications.index');
        Route::get('/reviews', function () { return view('admin.dashboard.index'); })->name('admin.reviews.index');
    });

    Route::prefix('/admin')->middleware('auth:web')->attribute('namespace', 'Admin')->as('admin.')->group( function () {
        // Route::get('/', function () { return view('admin.dashboard.index'); })->name('dashboard.index');
        Route::get('/', 'DashboradController@index')->name('dashboard.index');
        Route::resource('users', 'UserController')->only('index', 'edit', 'update', 'create', 'store');
        Route::get('/users/{user}/disable', 'UserController@disable')->name('users.disable');
        Route::get('/users/{user}/enable', 'UserController@enable')->name('users.enable');

    });

    Route::prefix('/api')->middleware('auth:web')->attribute('namespace', 'Api')->group( function () {
        Route::get('/users', 'UserController@index')->name('api.users.index');
    });

    Auth::routes();

    Route::get('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth:web');

    Route::get('login', 'Auth\LoginController@showLoginform')->name('login');

});

Route::group(['middleware' => 'language', 'where' => ['locale' => '[a-zA-Z]{2}']], function () {

    Route::get('{slug?}/', function (Request $request, $slug) {

        if( $slug == 'derma' )
            return redirect('الجلدية', 301);

        if( $slug == 'medical' )
            return redirect('الطبية', 301);

        # Check if slug is static page.
        if( array_key_exists($slug, $staticPages = PagesPathsEnums::staticPages) ){

            $app = app();
            $controller = $app->make($staticPages[$slug]['controller']);
            return $controller->callAction($staticPages[$slug]['action'], $parameters = array());

        }

        # Check if slug is blog category.
        $articlecat = BlogCategory::join('blog_category_translations', function (JoinClause $join) {
            $join->on('blog_category_translations.blog_category_id', '=', 'blog_categories.id');
        })->where('blog_category_translations.locale', app()->getLocale())
            ->where('blog_category_translations.slug', $slug)->first();

        if( $articlecat ){

            $app = app();
            $controller = $app->make('Modules\Blog\Controllers\Web\BlogController');
            return $controller->callAction('category', $parameters = [ 'slug' => $slug]);

        }

        # Check if slug is services.
        $service = Service::join('service_translations', function (JoinClause $join) {
            $join->on('service_translations.service_id', '=', 'services.id');
        })->where('service_translations.locale', app()->getLocale())
            ->where('service_translations.slug', $slug)->first();

        if( $service ){

            $app = app();
            $controller = $app->make('Modules\Service\Controllers\Web\ServiceController');
            return $controller->callAction('details', $parameters = [ 'slug' => $slug]);

        }

        # Check if slug is blog.
        $article = Blog::join('blog_translations', function (JoinClause $join) {
            $join->on('blog_translations.blog_id', '=', 'blogs.id');
        })->where('blog_translations.locale', app()->getLocale())
        ->where(function($query) use($slug)
        {
            $query->where('blog_translations.slug', $slug)
                   ->orWhere('blog_translations.new_slug', $slug);
        })
        ->first();

        if( $article ){

            $app = app();
            $controller = $app->make('Modules\Blog\Controllers\Web\BlogController');
            return $controller->callAction('details', $parameters = [ 'slug' => $slug]);

        }

        // return abort(404);
        return redirect(app()->getLocale() != 'ar' ? '/?lang=en' : '/', 301);
    });

});

