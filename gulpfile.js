var elixir = require('laravel-elixir');
var paths = {
    'jquery': './node_modules/jquery/',
    'bootstrap': './node_modules/bootstrap-sass/assets/'
}

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .copy(paths.bootstrap+'javascripts/bootstrap.min.js','public/js/bootstrap.min.js')
        .copy(paths.bootstrap+'fonts','public/fonts')
        .copy(paths.jquery+'dist/jquery.min.js','public/js/jquery.min.js')
});
