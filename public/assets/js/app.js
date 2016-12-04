var path = {
    plugins : myPrefix + 'assets/vendor/'
  };

var assets = {
  _discussion     : { 
                      js : myPrefix + 'assets/js/discussion.js'
                    },
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
  _navtab         : { 
                      css : path.plugins + 'kartik/tabs-x/css/bootstrap-tabs-x.min.css',
                      js : path.plugins + 'kartik/tabs-x/js/bootstrap-tabs-x.min.js'
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
  _timeago        : { 
                      js : path.plugins + 'timeago/js/jquery.timeago.js',
                      js_id : path.plugins + 'timeago/js/jquery.timeago.id.js'
                    },
  _icheck         : { 
                      css : path.plugins + 'iCheck/css/all.css',
                      js : path.plugins + 'iCheck/js/icheck.min.js',
                    },
  _autosize       : { 
                      js : path.plugins + 'autosize/js/autosize.min.js'
                    },
  _slimscroll     : { 
                      js : path.plugins + 'slimScroll/jquery.slimscroll.min.js'
                    },
  _inlineattachment : { 
                      js : path.plugins + 'inlineAttachment/jquery.inline-attachment.min.js'
                    },
  _jqueryForm     : { 
                      js : path.plugins + 'jquery-form/jquery.form.min.js'
                    },
  _notify         : { 
                      js : path.plugins + 'notify/bootstrap-notify.min.js',
                      animate : path.plugins + 'animate/animate.css'
                    },
};

var Site = {
  init : function() {
    Site.moment();
    Site.fileInput();
    Site.navtab();
    Site.select2();
    Site.textEditor();
    Site.timeAgo();
    Site.icheck();
    Site.autosize();
    Site.slimscroll();
    Site.discussion();
    Site.carousel();
    Site.notify();
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
              allowedFileTypes: $(this).data('allowed-file-types'),
              overwriteInitial: $(this).data('over-write-initial')
            });
          });
        }
      });
    }
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
  timeAgo : function() {
    Modernizr.load({
      load  : [
              assets._timeago.js,
              assets._timeago.js_id
      ],
      complete : function(){
        $('.time-humanize').each(function(index){
          $(this).timeago();
        });
      }
    });
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
  autosize : function() {
    if ($('textarea').length > 0) {
      Modernizr.load({
        load  : [
                assets._autosize.js,
        ],
        complete : function(){
          autosize($('textarea'));
        }
      });
    }
  },
  slimscroll : function() {
    if ($('.slimscroll').length > 0) {
      Modernizr.load({
        load  : [
                assets._slimscroll.js,
        ],
        complete : function(){
          $('.slimscroll').slimscroll();
        }
      });
    }
  },
  discussion : function() {
    Modernizr.load({
      load  : [
              assets._discussion.js,
      ],
      complete : function(){
        Discussion.load();
      }
    });
  },
  carousel : function() {
    if ($('.carousel').length > 0) {
      $('.carousel').carousel({
        interval: 3000
      });  
    }
  },
  notify : function() {
    Modernizr.load({
      load  : [
              assets._notify.js,
              assets._notify.animate,
      ],
      complete : function(){
        if ($('#notification-success').length > 0) {
          Site.showNotify('success', $('#notification-success'));
        }
        if ($('#notification-alert').length > 0) {
          Site.showNotify('warning', $('#notification-alert'));
        }
        if ($('#notification-info').length > 0) {
          Site.showNotify('info', $('#notification-info'));
        }
        if ($('#notification-error').length > 0) {
          Site.showNotify('danger', $('#notification-error'));
        }
      }
    });
  },
  showNotify : function($type, $selector) {
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