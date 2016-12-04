var lockMorePage = false;
var idDumpMessage = 0;
var Discussion = {
  load : function() {
    if ($('#discuss_idea').length > 0) {
      Discussion.init();
    }  
  },
  init : function() {
    Modernizr.load({
      load  : [
              assets._slimscroll.js,
              assets._jqueryForm.js
      ],
      complete : function(){
        Discussion.initSlimScroll();
        Discussion.initAjaxForm();
      }
    });
  },
  initSlimScroll : function() {
    $('#discuss_idea').slimscroll({
      height: 410,
      scrollTo: 10000
    });
    $('#discuss_idea').slimScroll().bind('slimscroll', function(e, pos){
      Discussion.morePage();
    });
  },
  morePage : function() {
    $discussHead = $('#discuss_idea');
    if ($discussHead.data('has-more-page') && !lockMorePage) {
      lockMorePage = true;
      $("#alert_loading").removeClass('hidden');
      $loading = $("#alert_loading").clone().addClass('hidden');
      $("#alert_loading").remove();
      $.get(
        $discussHead.data('href'),
        { last_message_id: $('.direct-chat-msg').first().data('message-id') },
        function($response) {
          if ($response.status == 'ok') {
            $discussHead.data('has-more-page', $response.has_more_page);
            for ($i = 0; $i < $response.data.length; $i++) {
              $message = '';
              $data = $response.data[$i]; 
              switch($data.type){
                case 'image':
                  $message = Discussion.templateMessageImage($data, $discussHead.data('user-id'));
                  break;
                case 'video':
                  $message = Discussion.templateMessageVideo($data, $discussHead.data('user-id'));
                  break;
                case 'file':
                  $message = Discussion.templateMessageFile($data, $discussHead.data('user-id'));
                  break;
                default:
                  $message = Discussion.templateMessageText($data, $discussHead.data('user-id'));
              }
              $discussHead.prepend($message);
            }
            $('.time-humanize').each(function(index){
              $(this).timeago();
            });
          }
          $discussHead.prepend($loading);
          lockMorePage = true;
        },
        "json" );
    }
  },
  initAjaxForm : function() {
    $('#discuss-form').ajaxForm({
      beforeSubmit:  Discussion.preAction,
      success:  Discussion.postAction,
      dataType: 'json',
      timeout:  30000
    });
  },
  preAction: function($formData, $jqForm, $options) {
    $valid = $("#discuss-msg").val().length > 0;
    if ($valid) {
      $discussHead = $('#discuss_idea');
      $data = {
        id: idDumpMessage,
        user_id: $discussHead.data('user-id'),
        user_name: $discussHead.data('user-name'),
        user_photo: $discussHead.data('user-photo'),
        content: $("#discuss-msg").val(),
        created_at: new Date().toISOString()
      };
      $("#discuss-msg").val('');
      $message = Discussion.templateMessageText($data, $discussHead.data('user-id'));
      $discussHead.append($message);
      $('.time-humanize').each(function(index){
        $(this).timeago();
      });
      $discussHead.animate({ scrollTop: 100000 }, "fast");
    }
    return $valid;
  },
  postAction : function($response, $status, $xhr, $form) {
    $discussHead = $('#discuss_idea');
    if ($response.status == 'ok') {
    }
  },
  templateMessageText : function(data, userId, dump = true){
    $element = '';
    if (data.user_id == userId) {
      $element += "<div class='direct-chat-msg right' data-message-id='" + data.id + "' data-dump='"+ dump +"'>";
      $element += "<div class='direct-chat-info clearfix'>";
      $element += "<span class='direct-chat-name pull-right'>" + data.user_name + "</span>";
      $element += "<span class='direct-chat-timestamp pull-left time-humanize' title='" + data.created_at + "'></span>";
      $element += "</div>";
      $element += "<img class='direct-chat-img' src='" + data.user_photo + "' alt='" + data.user_name + "'>";
      $element += "<div class='direct-chat-text'>" + data.content + "</div>";
      $element += "</div>";
    } else {
      $element += "<div class='direct-chat-msg' data-message-id='" + data.id + "' data-dump='"+ dump +"'>";
      $element += "<div class='direct-chat-info clearfix'>";
      $element += "<span class='direct-chat-name pull-left'>" + data.user_name + "</span>";
      $element += "<span class='direct-chat-timestamp pull-right time-humanize' title='" + data.created_at + "'></span>";
      $element += "</div>";
      $element += "<img class='direct-chat-img' src='" + data.user_photo + "' alt='" + data.user_name + "'>";
      $element += "<div class='direct-chat-text'>" + data.content + "</div>";
      $element += "</div>";
    }
    return $element;
  },
  templateMessageImage : function(data, userId){
    $element = '';
    return $element;
  },
  templateMessageVideo : function(data, userId){
    $element = '';
    return $element;
  },
  templateMessageFile : function(data, userId){
    $element = '';
    return $element;
  },
}