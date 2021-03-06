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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front.js', 'public/js/front')
    .js('resources/js/back/back.js', 'public/js/back')
    .js('resources/js/back/language.js', 'public/js/back')
    .js('resources/js/back/game.js', 'public/js/back')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/back/admin.scss', 'public/css/back')
    .react()
    .sourceMaps();
