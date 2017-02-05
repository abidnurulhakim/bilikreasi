var Site = {
  init : function() {
    Site.formMaterialize();
    Site.numfuzzInit();
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
    Site.timeagoInit();
    Discussion.init();
  },
  scrollHtmlInit : function () {
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
    $('.tooltipster').each(function(e){
      $(this).tooltipster({
        theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
        side: $(this).data('placement')
      });
    });
  },
  bannerInit : function() {
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
    });
  },
  popularIdeaInit : function() {
    $('section.popular-idea .idea-list').each(function(i){
      $(this).on('init', function(){
        Site.popularIdeaPushPinInit();
      });
      $(this).slick({
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        prevArrow: "",
        nextArrow: "",
        adaptiveHeight: true,
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
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
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
  numfuzzInit : function($selector = null) {
    if ($selector) {
      $selector.numFuzz();
    } else {
      $('.abbr-number').numFuzz();
    }
  },
  quickLookInit : function() {
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
      $('#cboxLoadedContent').slimScroll({
        height: '500px'
      });
      Site.numfuzzInit($('.quick-look--meta-number'));
    });
  },
  galleryQuickLookInit : function() {
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
    $('.grid').masonry({
      itemSelector: '.grid-item',
    });
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
    $('input[type=text].date-picker').each(function(index){
      $(this).datepicker({
        format: $(this).data('date-format'),
        endDate: $(this).data('end-date'),
      });
    });
  },
  textEditorInit : function() {
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
    $('.date-time-picker').each(function(index){
      $(this).datetimepicker({
        locale: 'id',
        format: 'DD/MM/YYYY HH:mm',
        viewDate: $(this).find('input').first().attr('value')
      });
    });
  },
  dateTimePickerLinkInit : function() {
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
    var token = '';
    $('[data-toggle="dropzone-input"]').each(function(index){
      token = $(this).data('token') ? $(this).data('token') : $(this).closest('form').find('input[name="_token"]').val();
      $(this).dropzone({
        url: $(this).attr('action'),
        paramName: $(this).data('param-name'),
        maxFilesize: $(this).data('max-file-size'),
        parallelUploads: 10,
        dictDefaultMessage: 'Masukkan gambar atau video',
        sending: function(file, xhr, formData) {
          formData.append("_token", token);
        },
      });
    });
  },
  galleryIdeaInit : function() {
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
  timeagoInit : function() {
    $('.time-humanize').timeago();
  },
};
Site.init();