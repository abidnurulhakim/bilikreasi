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
    mix.less('glyphicons.less', 'resources/assets/sass/components/_glyphicons.scss');
    mix.sass([
        '../vendor/animate.css/animate.min.css',
        '../vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        '../vendor/bootstrap-fileinput/css/fileinput.css',
        '../vendor/dropzone/dist/min/dropzone.min.css',
        '../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
        '../vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        '../vendor/font-awesome/css/font-awesome.min.css',
        '../vendor/summernote/dist/summernote.css',
        'app.scss',
        '../vendor/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
        ], 'public/css/application.css');
    mix.scripts([
        '../vendor/jquery/dist/jquery.min.js',
        '../vendor/bootstrap/dist/js/bootstrap.min.js',
        '../vendor/materialize/dist/js/materialize.min.js',
        '../vendor/moment/min/moment-with-locales.min.js',
        '../vendor/autosize/dist/autosize.min.js',
        '../vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        '../vendor/bootstrap-fileinput/js/fileinput.min.js',
        '../vendor/colorbox/jquery.colorbox-min.js',
        '../vendor/dropzone/dist/min/dropzone.min.js',
        '../vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        '../vendor/infinite-scroll/jquery.infinitescroll.min.js',
        '../vendor/jquery-form/jquery.form.js',
        '../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
        '../vendor/masonry/dist/masonry.pkgd.min.js',
        '../vendor/nicescroll/jquery.nicescroll.min.js',
        '../vendor/pusher/dist/web/pusher.js',
        '../vendor/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js',
        '../vendor/select2/dist/js/select2.full.min.js',
        '../vendor/slick-carousel/slick/slick.min.js',
        '../vendor/slimScroll/jquery.slimscroll.min.js',
        '../vendor/summernote/dist/summernote.min.js',
        '../vendor/summernote/dist/lang/summernote-id-ID.js',
        '../vendor/timeago/jquery.timeago.js',
        '../vendor/timeago/locales/jquery.timeago.id.js',
        '../vendor/tooltipster/dist/js/tooltipster.bundle.min.js',
        '../vendor/webui-popover/dist/jquery.webui-popover.min.js',
        'numfuzz.js',
        'discussion.js',
        'app.js',
        ], 'public/js/application.js');
    mix.version(['css/application.css', 'js/application.js']);
});
