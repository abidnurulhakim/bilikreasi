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
    _datatables     : {
                        css_jquery : path.plugins + 'datatables/jquery.dataTables.min.css',
                        js_jquery : path.plugins + 'datatables/jquery.dataTables.min.js',
                        css : path.plugins + 'datatables/dataTables.bootstrap.css',
                        js : path.plugins + 'datatables/dataTables.bootstrap.min.js',
                      },
    _colvis         : {
                        css : path.plugins + 'datatables/extensions/ColVis/css/dataTables.colVis.min.css',
                        js : path.plugins + 'datatables/extensions/ColVis/js/dataTables.colVis.min.js',
                      },
    _icheck         : { 
                        css : path.plugins + 'iCheck/css/all.css',
                        js : path.plugins + 'iCheck/js/icheck.min.js',
                      },
    _select2        : { 
                        css : path.plugins + 'select2/css/select2.min.css',
                        js : path.plugins + 'select2/js/select2.full.min.js'
                      },
    _summernote     : { 
                        css : path.plugins + 'summernote/summernote.css',
                        js : path.plugins + 'summernote/summernote.min.js',
                        lang : path.plugins + 'summernote/lang/summernote-id-ID.js'
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
  };

  var Site = {
    init : function() {
      Site.datatables();
      Site.fastClick();
      Site.slimScroll();
      Site.icheck();
      Site.select2();
      Site.textEditor();
      Site.moment();
      Site.fileInput();
      Site.adminLTE();
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
    datatables : function() {
      if ($('table').length > 0) {
        Modernizr.load({
          load  : [
            assets._datatables.css,
            assets._colvis.css,
            assets._datatables.js_jquery,
            assets._datatables.js,
            assets._colvis.js,
          ],
          complete: function(){
            $('table').each(function(index){
              $(this).DataTable({
                dom: 'C<"clear">lfrtip',
              });
            });
          }
        });
      }
    },
    icheck : function() {
      if ($('input').length > 0) {
        Modernizr.load({
          load  : [
                  assets._icheck.css,
                  assets._icheck.js,
          ],
          complete : function(){
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
              increaseArea: '10%' // optional
            });
          }
        });
      }
    },
    select2 : function() {
      if ($('select').length > 0) {
        Modernizr.load({
          load  : [
                  assets._select2.css,
                  assets._select2.js,
          ],
          complete : function(){
            $('select').each(function(e){
              if ($(this).data('tag')) {
                $(this).select2({
                  language: "id",
                  tags: true,
                  tokenSeparators: [',']
                })
              }else {
                $(this).select2({
                  language: "id",
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
          }
        });
      }
    },
    textEditor : function() {
      if ($('[summernote]').length > 0) {
        Modernizr.load({
          load  : [
                  assets._summernote.css,
                  assets._summernote.js,
                  assets._summernote.lang,
          ],
          complete : function(){
            $('[summernote]').each(function(index){
              $(this).summernote({
                  lang : 'id-ID',
                  placeholder : $(this).attr('placeholder'),
                  height : 300,
                  minHeight : 300,
                  focus : true,
                });
            });
          }
        });
      }
    },
    moment : function() {
      if ($('.date-time-picker').length > 0) {
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
      if ($('.date-time-picker-link').length > 0) {
        Modernizr.load({
          load  : assets._moment.js,
          complete: Site.dateTimePickerLink
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
          $('.date-time-picker').each(function(index){
            $(this).datetimepicker();
          });
        }
      });
    },
    dateTimePickerLink : function() {
      Modernizr.load({
        load  : [
                assets._datetimepicker.css,
                assets._datetimepicker.js
        ],
        complete : function() {
          $('.date-time-picker-link').each(function(index){            
            $(this).datetimepicker();
            $("#"+$(this).data('finish-selector')).datetimepicker({
                useCurrent: false
            });
            $(this).on("dp.change", function (e) {
                $("#"+$(this).data('finish-selector')).data("DateTimePicker").minDate(e.date);
            });
            $("#"+$(this).data('finish-selector')).on("dp.change", function (e) {
                $(this).data("DateTimePicker").maxDate(e.date);
            });
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
                  arr.push({showCaption: false, width: "120px", key: i, showZoom:false});
                }
              }
              $(this).fileinput({
                initialPreview: $(this).data('initial-preview-url'),
                showUpload: false,
                showDrag: true,
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