var elixir = require('laravel-elixir');

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

     mix.styles([
        'lib/bootstrap.min.css',
        'lib/font-awesome.min.css',
        'lib/bootstrap-datetimepicker.css',
        'lib/dropzone.min.css',
        'style.css',
    ]);

    mix.styles([
        'main-style.css'
    ],  'public/css/main-style.css');
    
    // mix.scripts([
    //     // 'moment.js',
        // 'bootstrap-datetimepicker.js',
    //     // "customscript.js"
    // ],'public/js/custom.js');

    mix.browserify('app.js', 'public/js/app.js');

});
