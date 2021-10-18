const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/back/sb-admin-2.js','public/js/back')
    .js('resources/js/back/chart-area-demo.js','public/js/back')
    .js('resources/js/back/chart-pie-demo.js','public/js/back')
    .js('resources/js/back/datatables-demo.js','public/js/back');

mix.sass('resources/sass/app.sass', 'public/css')
    .sass('resources/sass/back/admin.scss', 'public/css/back');
