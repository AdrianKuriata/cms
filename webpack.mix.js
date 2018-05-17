let mix = require('laravel-mix');

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

// This is needed if you using WindowsOS
mix.setPublicPath(path.normalize('C:/Users/Adrian/code/cms/packages/akuriatadev/wordit'));

mix.js('src/assets/js/app.js', 'src/public/js')
   .sass('src/assets/sass/app.scss', 'src/public/css');
