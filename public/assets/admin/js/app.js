;(function ( window, document, undefined ) {
   var path = {
    plugins : myPrefix + 'assets/vendor/'
  };

  var assets = {
    _jquery_local   : { js : path.plugins + 'jquery/js/jquery.min.js' },
    _fontawesome    : { css : path.plugins + 'font-awesome/css/font-awesome.min.css' },
    _bootstrap      : { 
                        css : path.plugins + 'bootstrap/css/bootstrap.min.css',
                        js : path.plugins + 'bootstrap/js/bootstrap.min.js'
                      },
    _adminlte       : {
                        css : path.plugins + 'AdminLTE/css/AdminLTE.min.css',
                        js : path.plugins + 'AdminLTE/js/AdminLTE.min.js',
                        skin : path.plugins + 'AdminLTE/css/skins/_all-skins.min.css',
                      },
    _fastclick      : { js : path.plugins + 'fastclick/fastclick.js' },
    _slimScroll     : { js : path.plugins + 'slimScroll/jquery.slimscroll.min.js' },
  };

  var Site = {
    init : function() {
      Site.adminLTE();
      Site.fastClick();
      Site.slimScroll();
    },
    adminLTE : function() {
      Modernizr.load({
        load  : [
          assets._adminlte.css,
          assets._adminlte.js,
          assets._adminlte.skin,
        ],
      });
    },
    fastClick : function() {
      Modernizr.load({
        load  : [
          assets._fastclick.js
        ],
      });
    },
    slimScroll : function() {
      Modernizr.load({
        load  : [
          assets._slimScroll.js
        ],
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
      assets._bootstrap.css,
      assets._bootstrap.js
    ],
    complete: checkJquery
  });
})( window, document );