const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.less('popover.less', 'resources/assets/sass/components/_popover.scss');
    mix.sass([
        '../vendor/font-awesome/css/font-awesome.min.css',
        'app.scss'
        ], 'public/css/application.css');
    mix.scripts([
        'modernizr.min.js',
        'numfuzz.js',
        'app.js'
        ], 'public/js/application.js');
    mix.version(['css/application.css', 'js/application.js']);
    /*copy dependencies*/
    mix.copy('resources/assets/vendor/jquery/dist', 'public/vendor/jquery');
    mix.copy('resources/assets/vendor/bootstrap/dist', 'public/vendor/bootstrap');
    mix.copy('resources/assets/vendor/materialize/dist', 'public/vendor/materialize');

    mix.copy('resources/assets/vendor/infinite-scroll', 'public/vendor/infinite-scroll');
    mix.copy('resources/assets/vendor/masonry/dist', 'public/vendor/masonry');
    mix.copy('resources/assets/vendor/slick/slick', 'public/vendor/slick');
    mix.copy('resources/assets/vendor/summernote/dist', 'public/vendor/summernote');
    mix.copy('resources/assets/vendor/webui-popover/dist', 'public/vendor/webui-popover');
    mix.copy('resources/assets/vendor/tooltipster/dist', 'public/vendor/tooltipster');
    mix.copy('resources/assets/vendor/slick-carousel/slick', 'public/vendor/slick');
    mix.copy('resources/assets/vendor/colorbox', 'public/vendor/colorbox');
});