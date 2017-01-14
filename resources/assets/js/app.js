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
                          css : path.plugins + 'summernote/summernote.min.css',
                          js : path.plugins + 'summernote/summernote.min.js',
                          lang : path.plugins + 'summernote/lang/summernote-id-ID.js'
                        },
  _tooltip            : { js : path.plugins + 'tooltipster/js/tooltipster.bundle.min.js' },
  _slick              : { js : path.plugins + 'slick/slick.min.js' },
  _colorbox           : { js : path.plugins + 'colorbox/jquery.colorbox-min.js' },
  _slimscroll         : { js : path.plugins + 'slimscroll/jquery.slimscroll.min.js' },
  _notify             : { js : path.plugins + 'notify/bootstrap-notify.min.js' },
  _select2            : { js : path.plugins + 'select2/js/select2.full.min.js' },
  _masonry            : { js : path.plugins + 'masonry/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
};

var Site = {
  init : function() {
    Site.formMaterialize();
    Site.numfuzz();
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
  textEditorInit : function() {
    $('[summernote]').each(function(){
      $(this).materialnote({
        lang : 'id-ID',
        height: $(this).height(),
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ]
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
      }else {
        $(this).select2({
          language: "id",
          theme: "bootstrap",
          placeholder: $(this).attr('placeholder')
        });
        $(this).on('change', function(evt){
          if ($(this).val() == 'event') {
            $('.show-cat-event').removeClass('hidden');
          } else {
            $('.show-cat-event').addClass('hidden');
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
    assets._bootstrap_local.js,
    assets._materialize_local.js,
  ],
  complete: checkJquery
});