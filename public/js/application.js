var path = {
    plugins : myPrefix + 'vendor/'
  };

var assets = {
  _jquery_local       : { js : path.plugins + 'jquery/dist/jquery.min.js' },
  _materialize_local  : { js : path.plugins + 'materialize/dist/js/materialize.min.js' },  
  _fontawesome        : { css : path.plugins + 'font-awesome/css/font-awesome.min.css' },
  _abbr_number        : { js : path.plugins + 'numfuzz/numfuzz.js' },
  _popover            : { 
                          css : path.plugins + 'webui-popover/dist/jquery.webui-popover.css',
                          js : path.plugins + 'webui-popover/dist/jquery.webui-popover.min.js'
                        },
  _slick              : { 
                          css : path.plugins + 'slick-carousel/slick/slick.css',
                          js : path.plugins + 'slick-carousel/slick/slick.min.js',
                        },
  _masonry            : { js : path.plugins + 'masonry/dist/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
  _materialnote       : { 
                          css : path.plugins + 'materialNote/css/materialNote.css',
                          js : path.plugins + 'materialNote/js/materialNote.min.js',
                          lang : path.plugins + 'summernote/dist/lang/summernote-id-ID.js'
                        },
  _summernote         : { 
                          css : path.plugins + 'summernote/dist/summernote.min.css',
                          js : path.plugins + 'summernote/dist/summernote.min.js',
                          lang : path.plugins + 'summernote/dist/lang/summernote-id-ID.js'
                        },

};

var Site = {
  init : function() {
    Site.abbrNumberInit();
    Site.navbarInit();
    Site.searchMenuBarInit();
    Site.popoverInit();
    Site.slickInit();
    Site.cardShare();
    Site.masonryLoad();
    Site.form();
    Site.materialNoteLoad();
  },
  abbrNumberInit : function() {
    Modernizr.load({
      load    : [
        assets._abbr_number.js,
      ],
      complete: function(){
        $('.abbr-number').numFuzz();
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
    Modernizr.load({
      load    : [
        assets._popover.css,
        assets._popover.js,
      ],
      complete: function(){
        $('.popover').each(function(){
          $(this).webuiPopover();
        });
      }
    });
  },
  slickInit : function() {
    Modernizr.load({
      load    : [
        assets._slick.css,
        assets._slick.js,
      ],
      complete: function(){
        Site.bannerInit();
        Site.popularIdeaInit();
      }
    });
  },
  bannerInit : function() {
    $('.banners').each(function(i){
      $(this).on('init', function(){
        Site.popularIdeaPushPinInit()
      });
      $(this).slick({
        dots: true,
        dotsClass: 'carousel-indicators',
        infinite: true,
        autoplay: true,
        speed: 300,
        prevArrow: "<a class='left carousel-control slick-prev'><span class='fa fa-chevron-left'></span></a>",
        nextArrow: "<a class='right carousel-control slick-next'><span class='fa fa-chevron-right'></span></a>",
        fade: true,
        cssEase: 'linear',
      });
    })
  },
  popularIdeaPushPinInit : function() {
    $('.pushpin').each(function(i){
      $target = $('#' + $(this).attr('data-target'));
      $offset = ($(window).width() <= 992) ? 200 : 400;
      $top = $target.offset().top + $offset;
      $bottom = $target.offset().top + $target.outerHeight() + $offset - 70;
      
      $(this).pushpin({
        top: $top,
        bottom: $bottom,
      });
    });
  },
  popularIdeaInit : function() {
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
  cardShare : function () {
    $('.card-share > a').on('click', function(e){ 
      e.preventDefault() // prevent default action - hash doesn't appear in url
      $(this).parent().find( 'div' ).toggleClass( 'card-social--active' );
      $(this).toggleClass('share-expanded');
    });  
  },
  masonryLoad : function(){
    if ($('.grid').length > 0) {
      Modernizr.load({
        load  : [
                assets._masonry.js,
                assets._infiniteScroll.js
        ],
        complete : Site.masonryInit
      });
    }
  },
  masonryInit : function(){
    $('.grid').masonry({
      itemSelector: '.grid-item',
    });
    Site.masonryLoadMore();
  },
  masonryLoadMore : function() {
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
  form : function() {
    $('.date-picker').each(function(){
      $(this).pickadate({
        max: $(this).data('end-date') == 'today' ? new Date : $(this).data('end-date'),
        selectMonths: true,
        selectYears: 200,
        format: $(this).data('date-format')
      });
    })
  },
  materialNoteLoad : function() {
    if ($('[summernote]').length > 0) {
      Modernizr.load({
        load  : [
                // assets._summernote.css,
                assets._summernote.js,
                // assets._materialnote.css,
                assets._materialnote.js,
                assets._materialnote.lang,
        ],
        complete : function(){
          Site.textEditorInit();
        }
      });
    }
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
    assets._fontawesome.css,
  ],
  complete: checkJquery
});
