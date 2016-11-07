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
    _datepicker     : { 
                        css : path.plugins + 'bootstrap/css/bootstrap-datepicker.min.css',
                        js : path.plugins + 'bootstrap/js/bootstrap-datepicker.min.js'
                      },
    _datetimepicker : { 
                        css : path.plugins + 'bootstrap/css/bootstrap-datetimepicker.min.css',
                        js : path.plugins + 'bootstrap/js/bootstrap-datetimepicker.min.js'
                      },
    _moment         : { 
                        js : path.plugins + 'moment/js/moment.min.js'
                      },
    _fileinput      : { 
                        css : path.plugins + 'kartik/file-input/css/fileinput.min.css',
                        js : path.plugins + 'kartik/file-input/js/fileinput.min.js'
                      },
    _typeahead      : { 
                        js : path.plugins + 'typeahead/js/typeahead.jquery.min.js',
                        bundle : path.plugins + 'typeahead/js/typeahead.bundle.min.js'
                      },
    _bloodhound      : { 
                        js : path.plugins + 'typeahead/js/bloodhound.min.js'
                      },                  
    _tagsinput      : { 
                        css : path.plugins + 'bootstrap/css/bootstrap-tagsinput.css',
                        js : path.plugins + 'bootstrap/js/bootstrap-tagsinput.js'
                      },
    _navtab         : { 
                        css : path.plugins + 'kartik/tabs-x/css/bootstrap-tabs-x.min.css',
                        js : path.plugins + 'kartik/tabs-x/js/bootstrap-tabs-x.min.js'
                      },
  };

  var Site = {
    init : function() {
      Site.moment();
      Site.fileInput();
      Site.typeahead();
      Site.navtab();
    },
    moment : function() {
      if ($('input[type="date"].date-time-picker').length > 0) {
        Modernizr.load({
          load  : assets._moment.js,
          complete: Site.dateTimePicker
        });
      }
      if ($('input[type="text"].date-picker').length > 0) {
        Modernizr.load({
          load  : assets._moment.js,
          complete: Site.datePicker
        });
      }
    },
    datePicker : function() {
      Modernizr.load({
        load  : [
                assets._datepicker.css,
                assets._datepicker.js
        ],
        complete : function() {
          $('input[type="text"].date-picker').each(function(index){
            $(this).datepicker({
              format: $(this).data('date-format'),
              endDate: $(this).data('end-date'),
            });
          });
        }
      });
    },
    dateTimePicker : function() {
      Modernizr.load({
        load  : [
                assets._datetimepicker.css,
                assets._datetimepicker.js
        ],
        complete : function() {
          $('.datetime-picker').each(function(index){
            $(this).datetimepicker();
          });
        }
      });
    },
    fileInput : function() {
      if ($('input[type="file"]').length > 0) {
        Modernizr.load({
          load  : [
                  assets._fileinput.css,
                  assets._fileinput.js
          ],
          complete : function() { 
            $('input[type="file"]').each(function(index){
              var arr = [];
              if ($(this).data('initial-preview-url')) {
                var initPreview = $(this).data('initial-preview-url');
                for (var i = 0; i < initPreview.length; i++) {
                  arr.push({showCaption: false, width: "120px", key: i, showDelete: false, showZoom:false});
                }
              }
              console.log($(this).data('initial-preview-url'))
              $(this).fileinput({
                initialPreview: $(this).data('initial-preview-url'),
                initialPreviewAsData: true,
                initialPreviewConfig: arr,
                maxFileCount: $(this).data('max-file-count'),
                maxFileSize: $(this).data('max-file-size'),
                allowedFileTypes: $(this).data('allowed-file-types')
              });
            });
          }
        });
      }
    },
    typeahead : function() {
      if ($('input[data-role="tagsinput"]').length > 0) {
        Modernizr.load({
          load  : [
                  assets._bloodhound.js,
                  assets._typeahead.js,
                  assets._typeahead.bundle,
          ],
          complete : Site.tagsInput
        });
      }
    },
    tagsInput : function() {
      Modernizr.load({
        load  : [
                assets._tagsinput.css,
                assets._tagsinput.js
        ],
        complete : function() {
          $('input[data-role="tagsinput"]').each(function(index){
            var values = $(this).data('value-typeahead');
            var dataLocal = [];
            for (var i = 0; i < values.length; i++) {
              dataLocal.push({name: values[i]});
            }
            var data = new Bloodhound({
              local: dataLocal,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            });
            data.initialize();

            $(this).tagsinput({
              typeaheadjs: {
                name: 'data',
                displayKey: 'name',
                valueKey: 'name',
                source: data.ttAdapter()
              }
            });
          });
          
        }
      });
    },
    navtab : function() {
      if ($('.tabs-x').length > 0) {
        Modernizr.load({
          load  : [
                  assets._navtab.css,
                  assets._navtab.js,
          ],
        });
      }
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