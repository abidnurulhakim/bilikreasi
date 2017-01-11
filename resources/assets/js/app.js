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

};

var Site = {
  init : function() {
    Site.navbarInit();
    Site.searchMenuBarInit();
    Site.popoverInit();
    Site.formMaterialize();
    Site.bannerInit();
    Site.popularIdeaInit();
    Site.numfuzz();
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
    Modernizr.load({
      load    : [
        assets._popover.js
      ],
      complete: function(){
        $('.popover').each(function(){
          $popupTrigger = $(this).data('trigger') ? $(this).data('trigger') : 'click';
          $(this).webuiPopover({
            trigger: $popupTrigger,
          });
        });
      }
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
  tooltip : function(){
    if ($('.tooltipster').length > 0) {
      Modernizr.load({
        load  : [
          assets._tooltip.js
        ],
        complete : function() {
          $('.tooltipster').each(function(e){
            $(this).tooltipster({
              theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
              side: $(this).data('placement')
            });
          });
        }
      });
    }
  },
  bannerInit : function() {
    Site.slickLoad(Site.banner);
  },
  slickLoad : function($callback) {
    Modernizr.load({
      load    : [
        assets._slick.js,
      ],
      complete: function(){
        $callback();
      }
    });
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
  numfuzz : function() {
    $('.abbr-number').numFuzz();
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