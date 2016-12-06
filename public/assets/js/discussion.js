var lockMorePage = false;
var messageIdDump = 0;
var pusher;
var discussionHead;
var channel;
var Discussion = {
  load : function() {
    if ($('#discussion-idea').length > 0) {
      discussionHead = $('#discussion-idea').first();
      Discussion.init();
    }  
  },
  init : function() {
    Modernizr.load({
      load  : [
              assets._slimscroll.js,
              assets._jqueryForm.js,
              assets._pusher.js
      ],
      complete : function(){
        Discussion.initSlimScroll();
        Discussion.initAjaxForm();
        Discussion.initPusher();
        Discussion.pusherBind();
      }
    });
  },
  initPusher : function () {
    pusher = new Pusher(pusherKey, {
        cluster: 'ap1',
        encrypted: true,
        auth: {
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
            }
    });
  },
  pusherBind : function() {
    channel = 'private-discussion.' + discussionHead.data('id');
    $channel = pusher.subscribe('private-discussion.' + discussionHead.data('id'));
    $channel.bind('discussion.new.message', function($data){
      if ($data.message.user_id != discussionHead.data('user-id')) {
        discussionHead.append(Discussion.addMessage($data.message));
        discussionHead.animate({ scrollTop: 100000 }, "fast");
        $('.time-humanize').each(function(index){
          $(this).timeago();
        });
      }
      Discussion.markReadMessages();
    });
  },
  initSlimScroll : function() {
    $('#discussion-idea').slimscroll({
      height: 410,
      scrollTo: 10000
    });
    $('#discussion-idea').slimScroll().bind('slimscroll', function(e, pos){
      Discussion.morePage();
    });
  },
  initAjaxForm : function() {
    $('#discussion-form').ajaxForm({
      target:    '#message_' + messageIdDump,
      beforeSubmit:  Discussion.preAction,
      success:  Discussion.postAction,
      dataType: 'json',
      timeout:  30000
    });
  },
  morePage : function() {
    if (discussionHead.data('has-more-page') && !lockMorePage) {
      lockMorePage = true;
      $("#alert_loading").removeClass('hidden');
      $loading = $("#alert_loading").clone().addClass('hidden');
      $("#alert_loading").remove();
      $.get(
        discussionHead.data('url-read-message'),
        { last_message_id: $('.direct-chat-msg').first().data('message-id') },
        function($response) {
          discussionHead = $('#discussion-idea');
          if ($response.status == 'ok') {
            discussionHead.data('has-more-page', $response.has_more_page);
            for ($i = 0; $i < $response.data.length; $i++) {
              $data = $response.data[$i]; 
              discussionHead.prepend(Discussion.addMessage($data));
            }
            $('.time-humanize').each(function(index){
              $(this).timeago();
            });
          }
          discussionHead.prepend($loading);
          lockMorePage = false;
        },
        "json" );
    }
  },
  markReadMessages : function(){
    $.get(
        discussionHead.data('url-unread-message'),
        {},
        function($response) {},
        "json" );
  },
  preAction: function($formData, $jqForm, $options) {
    $valid = $("#discussion-msg").val().length > 0;
    $objDump = Object.assign({}, $formData[0]);
    $objDump.name = 'message_id_dump';
    $objDump.required = 'false';
    $objDump.type = 'hidden';  
    $objDump.value = messageIdDump;
    $formData.push($objDump);
    if ($valid) {
      $identifier = 'message_' + messageIdDump;
      discussionHead = $('#discussion-idea');
      $data = {
        id: messageIdDump,
        id_dump: messageIdDump,
        user_id: discussionHead.data('user-id'),
        user_name: discussionHead.data('user-name'),
        user_photo: discussionHead.data('user-photo'),
        content: $("#discussion-msg").val(),
        created_at: new Date().toISOString()
      };
      messageIdDump++;
      $("#discussion-msg").val('');
      $message = Discussion.templateMessageText($data, discussionHead.data('user-id'));
      discussionHead.append($message);
      $('.time-humanize').each(function(index){
        $(this).timeago();
      });
      discussionHead.animate({ scrollTop: 100000 }, "fast");
    }
    return $valid;
  },
  postAction : function($response, $status, $xhr, $form) {
    discussionHead = $('#discussion-idea');
    if ($response.status == 'ok') {
      $selector = $('[data-message-id-dump='+$response.message_id_dump+']');
      $selector.attr('data-message-id', $response.message_id);
      $selector.data('message-id', $response.message_id);
    }
  },
  addMessage : function($data) {
    $message = '';
    switch($data.type){
      case 'image':
        $message = Discussion.templateMessageImage($data, discussionHead.data('user-id'));
        break;
      case 'video':
        $message = Discussion.templateMessageVideo($data, discussionHead.data('user-id'));
        break;
      case 'file':
        $message = Discussion.templateMessageFile($data, discussionHead.data('user-id'));
        break;
      default:
        $message = Discussion.templateMessageText($data, discussionHead.data('user-id'));
    }
    return $message;
  },
  templateMessageText : function(data, userId, dump = true){
    $element = '';
    if (data.user_id == userId) {
      $element += "<div class='direct-chat-msg right' data-message-id='" + data.id + "' data-message-id-dump='"+ data.id_dump +"'>";
      $element += "<div class='direct-chat-info clearfix'>";
      $element += "<span class='direct-chat-name pull-right'>" + data.user_name + "</span>";
      $element += "<span class='direct-chat-timestamp pull-left time-humanize' title='" + new Date(data.created_at).toISOString() + "'></span>";
      $element += "</div>";
      $element += "<img class='direct-chat-img' src='" + data.user_photo + "' alt='" + data.user_name + "'>";
      $element += "<div class='direct-chat-text'>" + data.content + "</div>";
      $element += "</div>";
    } else {
      $element += "<div class='direct-chat-msg' data-message-id='" + data.id + "' data-dump='"+ dump +"'>";
      $element += "<div class='direct-chat-info clearfix'>";
      $element += "<span class='direct-chat-name pull-left'>" + data.user_name + "</span>";
      $element += "<span class='direct-chat-timestamp pull-right time-humanize' title='" + new Date(data.created_at).toISOString() + "'></span>";
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