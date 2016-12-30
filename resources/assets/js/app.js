var path = {
    plugins : myPrefix + 'vendor/'
  };

var assets = {
  _jquery_local       : { js : path.plugins + 'jquery/jquery.min.js' },
  _materialize_local  : { js : path.plugins + 'materialize/js/materialize.min.js' },
  _bootstrap_local    : { js : path.plugins + 'bootstrap/js/bootstrap.min.js' },  
  _abbr_number        : { js : path.plugins + 'numfuzz/numfuzz.js' },
  _popover            : { 
                          js : path.plugins + 'webui-popover/jquery.webui-popover.min.js'
                        },
  _slick              : { 
                          css : path.plugins + 'slick/slick.css',
                          js : path.plugins + 'slick/slick.min.js',
                        },
  _masonry            : { js : path.plugins + 'masonry/masonry.pkgd.min.js' },
  _infiniteScroll     : { js : path.plugins + 'infinite-scroll/jquery.infinitescroll.min.js' },
  _summernote         : { 
                          css : path.plugins + 'summernote/summernote.min.css',
                          js : path.plugins + 'summernote/summernote.min.js',
                          lang : path.plugins + 'summernote/lang/summernote-id-ID.js'
                        },

};

var Site = {
  init : function() {
    Site.navbarInit();
    Site.searchMenuBarInit();
    Site.popoverInit();
    Site.formMaterialize();
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
        assets._popover.js,
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
        $(this).prev().trigger('click');
      });
    });
  }
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