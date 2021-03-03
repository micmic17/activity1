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
  .sass('resources/sass/app.scss', 'public/css')
  .js('resources/js/admin/profile.js', 'public/js/admin')
  .sass('resources/sass/admin/profile.scss', 'public/css/admin')
  .js('resources/js/admin/employee.js', 'public/js/admin')
  .sourceMaps();