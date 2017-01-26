var path = {
    plugins : myPrefix + 'vendor/'
  };
var assets = {
  _jquery_local       : { js : path.plugins + 'jquery/jquery.min.js' },
  _materialize_local  : { js : path.plugins + 'materialize/js/materialize.min.js' },
  _bootstrap_local    : { js : path.plugins + 'bootstrap/js/bootstrap.min.js' },
  _abbr_number        : { js : path.plugins + 'numfuzz/numfuzz.js' },
  _popover            : { js : path.plugins + 'webui-popover/jquery.webui-popover.min.js' },
  _masonry            : { js : path.plugins + 'masonry/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
  _summernote         : {
                          css : path.plugins + 'summernote/summernote.css',
                          js : path.plugins + 'summernote/summernote.min.js',
                          lang : path.plugins + 'summernote/lang/summernote-id-ID.js'
                        },
  _tooltip            : { js : path.plugins + 'tooltipster/js/tooltipster.bundle.min.js' },
  _slick              : { js : path.plugins + 'slick/slick.min.js' },
  _colorbox           : { js : path.plugins + 'colorbox/jquery.colorbox-min.js' },
  _slimscroll         : { js : path.plugins + 'slimscroll/jquery.slimscroll.min.js' },
  _notify             : { js : path.plugins + 'notify/bootstrap-notify.min.js' },
  _select2            : { js : path.plugins + 'select2/js/select2.full.min.js' },
  _niceScroll         : { js : path.plugins + 'nicescroll/jquery.nicescroll.min.js' },
  _fileinput          : {
                          css : path.plugins + 'bootstrap-fileinput/css/fileinput.min.css',
                          js : path.plugins + 'bootstrap-fileinput/js/fileinput.min.js'
                        },
  _datepicker         : {
                          css : path.plugins + 'bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                          js : path.plugins + 'bootstrap-datepicker/js/bootstrap-datepicker.min.js'
                        },
  _datetimepicker     : {
                          css : path.plugins + 'bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                          js : path.plugins + 'bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'
                        },
  _moment             : { js : path.plugins + 'moment/moment-with-locales.min.js' },
  _dropzone           : {
                          css : path.plugins + 'dropzone/dropzone.min.css',
                          js : path.plugins + 'dropzone/dropzone.min.js'
                        },
  _customScrollbar    : {
                          css : path.plugins + 'custom-scrollbar/jquery.mCustomScrollbar.min.css',
                          js : path.plugins + 'custom-scrollbar/jquery.mCustomScrollbar.js'
                        },
};

var Site = {
  init : function() {
    Site.formMaterialize();
    Site.numfuzz();
    Site.scrollHtmlInit();
    Site.bannerInit();
    Site.navbarInit();
    Site.popoverInit();
    Site.popularIdeaInit();
    Site.quickLookInit();
    Site.searchMenuBarInit();
    Site.tooltipInit();
    Site.alertNotificationInit();
    Site.selectInit();
    Site.masonryInit();
    Site.imageInputInit();
    Site.datepickerInit();
    Site.textEditorInit();
    Site.dateTimePickerInit();
    Site.dateTimePickerLinkInit();
    Site.dropzoneFileInputInit();
    Site.galleryIdeaInit();
    Site.discussionInit();
  },
  slickLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._slick.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  colorboxLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._colorbox.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  slimscrollLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._slimscroll.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  popoverLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._popover.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  tooltipLoad : function($callback, $args = []) {
    Modernizr.load({
      load    : [
        assets._tooltip.js,
      ],
      complete: function(){
        $callback(...$args);
      }
    });
  },
  notifyLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._notify.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  select2Load : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._select2.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  masonryLoad : function($callback, $args = []){
    Modernizr.load({
      load  : [
              assets._masonry.js,
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  infiniteScrollLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._infiniteScroll.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  niceScrollLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._niceScroll.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  fileInputLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._fileinput.css,
              assets._fileinput.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  datepickerLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._datepicker.css,
              assets._datepicker.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  summernoteLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._summernote.css,
              assets._summernote.js,
              assets._summernote.lang
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  dateTimePickerLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._datetimepicker.css,
              assets._datetimepicker.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  momentLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._moment.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  dropzoneLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._dropzone.css,
              assets._dropzone.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  customScrollbarLoad : function($callback, $args = []) {
    Modernizr.load({
      load  : [
              assets._customScrollbar.css,
              assets._customScrollbar.js
      ],
      complete : function(){
        $callback(...$args);
      }
    });
  },
  scrollHtmlInit : function () {
    Site.niceScrollLoad(Site.scrollHtml);
  },
  scrollHtml : function () {
    $("html").niceScroll({
      mousescrollstep: 80
    });
  },
  navbarInit : function() {
    $(".button-collapse").sideNav();
  },
  searchMenuBarInit : function(){
    $('.searchbox-icon').click(function(){
      if($('.searchbox.searchbox-open').length == 0){
        $('.searchbox').addClass('searchbox-open');
        $('.searchbox-input').focus();
      } else {
        $('.searchbox').removeClass('searchbox-open');
        $('.searchbox-input').focusout();
      }
    });
    $('.searchbox-mobile-icon').click(function(){
      if($('.searchbox-mobile.open').length == 0){
        $('.searchbox-mobile').addClass('open');
        $('.searchbox-input').focus();
      } else {
        $('.searchbox-mobile').removeClass('open');
        $('.searchbox-input').focusout();
      }
    });
  },
  popoverInit : function() {
    if ($('.popover').length > 0) {
      Site.popoverLoad(Site.popover);
    }
  },
  popover : function() {
    $('.popover').each(function(){
      $popupTrigger = $(this).data('trigger') ? $(this).data('trigger') : 'click';
      $(this).webuiPopover({
        trigger: $popupTrigger,
      });
    });
  },
  formMaterialize : function() {
    $('.input-field label').each(function(){
      $(this).click(function() {
        $(this).prev().focus();
      });
    });
  },
  tooltipInit : function() {
    if ($('.tooltipster').length > 0) {
      Site.tooltipLoad(Site.tooltip);
    }
  },
  tooltip : function(){
    $('.tooltipster').each(function(e){
      $(this).tooltipster({
        theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
        side: $(this).data('placement')
      });
    });
  },
  bannerInit : function() {
    Site.slickLoad(Site.banner);
  },
  banner : function() {
    $('.banners').each(function(i){
      $(this).slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 300,
        prevArrow: "<a class='left slider-control slick-prev'><i class='fa fa-chevron-left fa-lg'></i></a>",
        nextArrow: "<a class='right slider-control slick-next'><i class='fa fa-chevron-right fa-lg'></i></a>",
        fade: true,
        cssEase: 'linear',
      });
    })
  },
  popularIdeaInit : function() {
    Site.slickLoad(Site.popularIdea);
  },
  popularIdea : function() {
    $('section.popular-idea .idea-list').each(function(i){
      $(this).on('init', function(){
        Site.popularIdeaPushPinInit()
      });
      $(this).slick({
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        prevArrow: "",
        nextArrow: "",
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    });
  },
  popularIdeaPushPinInit : function() {
    $('.pushpin').each(function(i){
      $target = $('#' + $(this).attr('data-target'));
      $top = $target.offset().top;
      $bottom = $target.offset().top + $target.outerHeight();
      $(this).pushpin({
        top: $top,
        bottom: $bottom,
      });
    });
  },
  numfuzz : function($selector = null) {
    if ($selector) {
      $selector.numFuzz();
    } else {
      $('.abbr-number').numFuzz();
    }
  },
  quickLookInit : function() {
    if ($('.quick-look').length > 0) {
      Site.colorboxLoad(Site.quickLook);
    }
  },
  quickLook : function() {
    $('.quick-look').each(function(i){
      $maxWidth = '75%';
      if ($(window).width() < 992) {
        $maxWidth = '95%';
      }
      $(this).colorbox({
        transition: 'fade',
        maxWidth: $maxWidth,
        height: '500px',
        title: false,
        close: '<i class="fa fa-close"></i>',
        className: 'quick-look--modal'
      });
    });
    $(document).bind('cbox_complete', function(){
      Site.galleryQuickLookInit();
      Site.slimscrollLoad(Site.colorboxScroll, ['500px']);
      Site.numfuzz($('.quick-look--meta-number'));
    });
  },
  colorboxScroll : function($height) {
    $('#cboxLoadedContent').slimScroll({
      height: $height
    });
  },
  galleryQuickLookInit : function() {
    Site.slickLoad(Site.galleryQuickLook);
  },
  galleryQuickLook : function() {
    $('.quick-look--modal .gallery').slick({
      dots: true,
      infinite: true,
      autoplay: true,
      speed: 300,
      prevArrow: "<a class='left slider-control slick-prev'><i class='fa fa-chevron-left fa-lg'></i></a>",
      nextArrow: "<a class='right slider-control slick-next'><i class='fa fa-chevron-right fa-lg'></i></a>",
      fade: true,
      cssEase: 'linear',
    });
  },
  alertNotificationInit : function() {
    Site.notifyLoad(Site.alertNotification);
  },
  alertNotification : function() {
    if ($('#notification-success').length > 0) {
      Site.showAlertNotification('success', $('#notification-success'));
    }
    if ($('#notification-alert').length > 0) {
      Site.showAlertNotification('warning', $('#notification-alert'));
    }
    if ($('#notification-info').length > 0) {
      Site.showAlertNotification('info', $('#notification-info'));
    }
    if ($('#notification-error').length > 0) {
      Site.showAlertNotification('danger', $('#notification-error'));
    }
  },
  showAlertNotification : function($type, $selector) {
    $.notify({
      message: $selector.data('text'),
    },{
      // settings
      element: 'body',
      position: null,
      type: $type,
      allow_dismiss: true,
      placement: {
        from: "top",
        align: "center"
      },
      offset: 200,
      spacing: 10,
      z_index: 1031,
      delay: 2500,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0} text-center" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
          '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
      '</div>'
    });
  },
  selectInit : function () {
    if ($('select').length > 0) {
      Site.select2Load(Site.select);
    }
  },
  select : function() {
    $('select').each(function(e){
      if ($(this).data('tag')) {
        $(this).select2({
          language: "id",
          tags: true,
          theme: "bootstrap",
          tokenSeparators: [',']
        })
      } else {
        $(this).select2({
          language: "id",
          theme: "bootstrap",
          placeholder: $(this).attr('placeholder')
        });
        $(this).on('change', function(evt){
          if ($(this).val() == 'event') {
            $('.show-cat-event').removeClass('hidden');
            $('.show-cat-event').removeClass('hidden-xs-up');
          } else {
            $('.show-cat-event').addClass('hidden');
            $('.show-cat-event').addClass('hidden-xs-up');
          }
        });
      }
    });
  },
  masonryInit : function(){
    if ($('.grid').length > 0) {
      Site.masonryLoad(Site.masonry);
    }
  },
  masonry : function(){
    $('.grid').masonry({
      itemSelector: '.grid-item',
    });
    Site.infiniteScrollLoad(Site.masonryItemMore);
  },
  masonryItemMore : function() {
    $('.grid').infinitescroll({
      navSelector  : ".read-more",
      nextSelector : ".read-more a",
      itemSelector : ".grid-item",
      loading: {
        finishedMsg: 'No more pages to load.'
        }
      },
      function( $newElements ) {
        $('.grid').masonry( 'appended', $newElements, true );
    });
  },
  imageInputInit : function() {
    if ($('.image-input').length > 0) {
      $('.image-input input[type=file]').each(function(){
        $(this).change(function(){
          if (this.files && this.files[0]) {
            $reader = new FileReader();
            $reader.readAsDataURL(this.files[0]);
            $prev = $(this).prev();
            $reader.onload = function (e) {
              $prev.attr('src', e.target.result).fadeIn('slow');
            }
          }
        });
      });
    }
  },
  datepickerInit : function() {
    if ($('input[type=text].date-picker').length > 0) {
      Site.datepickerLoad(Site.datepicker);
    }
  },
  datepicker : function() {
    $('input[type=text].date-picker').each(function(index){
      $(this).datepicker({
        format: $(this).data('date-format'),
        endDate: $(this).data('end-date'),
      });
    });
  },
  textEditorInit : function() {
    if ($('[text-editor]').length > 0) {
      Site.summernoteLoad(Site.textEditor);
    }
  },
  textEditor : function() {
    $('[text-editor]').each(function(){
      $(this).summernote({
        lang : 'id-ID',
        height: 200,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['view', ['fullscreen', 'codeview', 'undo', 'redo']]
        ]
      });
    });
  },
  dateTimePickerInit : function() {
    if ($('.date-time-picker').length > 0) {
      Site.momentLoad(Site.dateTimePickerLoad, [Site.dateTimePicker]);
    }
  },
  dateTimePicker : function() {
    $('.date-time-picker').each(function(index){
      $(this).datetimepicker({
        locale: 'id',
        format: 'DD/MM/YYYY HH:mm',
        viewDate: $(this).find('input').first().attr('value')
      });
    });
  },
  dateTimePickerLinkInit : function() {
    if ($('.date-time-picker-link').length > 0) {
      Site.momentLoad(Site.dateTimePickerLoad, [Site.dateTimePickerLink]);
      ;
    }
  },
  dateTimePickerLink : function() {
    $('.date-time-picker-link').each(function(index){
      $(this).datetimepicker({
        locale: 'id',
        format: 'DD/MM/YYYY HH:mm',
        viewDate: $(this).attr('value')
      });
      $(this).show();
      $("#"+$(this).data('finish-selector')).datetimepicker({
        useCurrent: false,
        locale: 'id',
        format: 'DD/MM/YYYY HH:mm',
        viewDate: $("#"+$(this).data('finish-selector')).attr('value')
      });
      $(this).on("dp.change", function (e) {
        $("#"+$(this).data('finish-selector')).data("DateTimePicker").minDate(e.date);
      });
      $("#"+$(this).data('finish-selector')).on("dp.change", function (e) {
        $(this).data("DateTimePicker").maxDate(e.date);
      });
    });
  },
  dropzoneFileInputInit : function() {
    if ($('[data-toggle="dropzone-input"]').length > 0) {
      Site.dropzoneLoad(Site.dropzoneFileInput);
    }
  },
  dropzoneFileInput : function() {
    var token = '';
    $('[data-toggle="dropzone-input"]').each(function(index){
      token = $(this).data('token') ? $(this).data('token') : $(this).closest('form').find('input[name="_token"]').val();
      $(this).dropzone({
        url: $(this).attr('action'),
        paramName: $(this).data('param-name'),
        maxFilesize: $(this).data('max-file-size'),
        parallelUploads: 10,
        sending: function(file, xhr, formData) {
          formData.append("_token", token);
        },
      });
    });
  },
  galleryIdeaInit : function() {
    if ($('.gallery').length > 0) {
      Site.slickLoad(Site.galleryIdea);
    }
  },
  galleryIdea : function() {
    $('.gallery').each(function(i){
      $(this).slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 300,
        prevArrow: "<a class='left slider-control slick-prev'><i class='fa fa-chevron-left fa-lg'></i></a>",
        nextArrow: "<a class='right slider-control slick-next'><i class='fa fa-chevron-right fa-lg'></i></a>",
        fade: true,
        cssEase: 'linear',
      });
    });
  },
  discussionInit : function() {
    if ($('.discussion').length > 0) {
      Site.customScrollbarLoad(Site.discussion);
    }
  },
  discussion : function() {
    $('.discussion').each(function(i){
      $discussions = $(this).find('.discussion--list');
      $messages = $(this).find('.discussion--messages');
      $discussions.mCustomScrollbar({
          axis:'y',
          theme: 'minimal-dark',
          moveDragger: true
      });
      $messages.mCustomScrollbar({
          axis:'y',
          theme: 'minimal-dark',
          moveDragger: true,
      });
      $messages.mCustomScrollbar("scrollTo","bottom",{
        scrollInertia: 1
      });
    });
  },
};

var checkJquery = function () {
  Modernizr.load([
    {
      test    : window.jQuery,
      nope    : assets._jquery_local.js,
      complete: Site.init
    }
  ]);
};

Modernizr.load({
  load    : [
    assets._jquery_local.js,
    assets._materialize_local.js,
    assets._bootstrap_local.js,
  ],
  complete: checkJquery
});
