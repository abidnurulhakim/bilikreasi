var path = {
    plugins : myPrefix + 'vendor/'
  };

var assets = {
  _jquery_local   : { js : path.plugins + 'jquery/js/jquery.min.js' },
  _fontawesome    : { css : path.plugins + 'font-awesome/css/font-awesome.min.css' },
};

var Site = {
  init : function() {
    Site.searchMenuBarInit();
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
    assets._fontawesome.css,
  ],
  complete: checkJquery
});
