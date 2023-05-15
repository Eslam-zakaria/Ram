const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'public/assets/css/main.css',
    'public/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
    'node_modules/nprogress/nprogress.css'
], 'public/assets/css/app.css');


mix.js('resources/js/app.js', 'public/assets/js/vue.app.js');

mix.scripts([
    'public/assets/js/vue.app.js',
    'public/assets/vendor/global/global.min.js',
    'public/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
    'public/assets/js/custom.min.js',
    'public/assets/js/deznav-init.js',
    'public/assets/vendor/peity/jquery.peity.min.js',
    'node_modules/nprogress/nprogress.js'
], 'public/assets/js/app.js');

mix.scripts([
    'public/assets/vendor/chart.js/Chart.bundle.min.js',
    'public/assets/vendor/apexchart/apexchart.js',
    'public/assets/js/dashboard/dashboard-1.js'

], 'public/assets/js/dashboard.js');


// Frontend Version
//
// mix.styles([
//     "public/web/assets/css/bootstrap.min.css",
//     "public/web/assets/css/owlcarousel/owl.carousel.min.css",
//     "public/web/assets/css/owlcarousel/owl.theme.default.min.css",
//     "public/web/assets/css/animate.min.css",
//     "public/web/assets/css/aos.css",
//     "public/web/assets/css/main-style.min.css"
// ], 'public/web/assets/css/app.css');

//
//
// mix.scripts([
//     "public/web/assets/js/jquery-3.4.1.min.js",
//     "public/web/assets/js/bootstrap.bundle.min.js",
//     "public/web/assets/js/owl.carousel.min.js",
//     "public/web/assets/js/aos.js",
//     "public/web/assets/js/app.js"
//
// ], 'public/web/assets/js/app.min.js');
