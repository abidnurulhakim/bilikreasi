var messageIdDump = 0;
var pusher;
var channel;
var Discussion = {
  load : function() {
    $('.discussion').each(function(i){
      discussionData = $('.discussion--messages').first();
      discussionGroup = $('.discussion--messages .discussion--message-group').first();
      $discussions = $(this).find('.discussion--list');
      $messages = $(this).find('.discussion--messages');
      $discussions.mCustomScrollbar({
        axis:'y',
        theme: 'minimal-dark',
        moveDragger: true
      });
      $messages.mCustomScrollbar({
        axis:'y',
        theme: 'minimal-dark',
        moveDragger: true,
        callbacks: {
          onOverflowYNone: function() {
            Discussion.morePage();
          },
          onScroll: function() {
            if (this.mcs.top > -50 && discussionData.data('has-more-page')) {
              Discussion.morePage();
            }
          },          
        }
      });
      $messages.mCustomScrollbar('scrollTo', 'bottom', {
        scrollInertia: 1
      });
      Discussion.initAjaxForm();
      Discussion.initPusher();
      Discussion.pusherBind();
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
    channel = 'private-discussion.' + discussionData.data('id');
    $channel = pusher.subscribe('private-discussion.' + discussionData.data('id'));
    $channel.bind('discussion.new.message', function($data){
      if ($data.message.user_id != discussionData.data('user-id')) {
        discussionGroup.append(Discussion.addMessage($data.message));
        $('.discussion--messages').mCustomScrollbar("scrollTo","bottom",{
          scrollInertia: 1
        });
        $('.time-humanize').each(function(index){
          $(this).timeago();
        });
      }
      Discussion.markReadMessages();
    });
  },
  initAjaxForm : function() {
    $('#discussion--input-message--form').ajaxForm({
      beforeSubmit:  Discussion.preAction,
      success:  Discussion.postAction,
      dataType: 'json',
      timeout:  30000
    });
  },
  morePage : function() {
    if (discussionData.data('has-more-page')) {
      $('#alert_loading').removeClass('hidden-xs-up');
      $loading = $("#alert_loading").clone();
      $('#alert_loading').remove();
      $firstMessage = $('.discussion--message').first();
      discussionGroup.prepend($loading);
      $.get(
        discussionData.data('url-read-message'),
        { last_message_id: $firstMessage.data('message-id') },
        function($response) {
          $('#alert_loading').addClass('hidden-xs-up');
          if ($response.status == 'ok') {
            discussionData.data('has-more-page', $response.has_more_page);
            for ($i = 0; $i < $response.data.length; $i++) {
              $data = $response.data[$i];
              if ($('.discussion--message[data-message-id="' + $data.id + '"]').length == 0) {
                discussionGroup.prepend(Discussion.addMessage($data, discussionData.data('user-id')));
              }  
            }
            $('.time-humanize').each(function(index){
              $(this).timeago();
            });
          }
          $('.discussion--messages').mCustomScrollbar('scrollTo',
            $('.discussion--message[data-message-id="' + $firstMessage.data('message-id') + '"]'),
            { scrollInertia: 1 }
          );
          $('#alert_loading').remove();
          discussionGroup.prepend($loading);
          $('#alert_loading').addClass('hidden-xs-up');
        },
        'json');
    }
  },
  markReadMessages : function(){
    $.get(
        discussionData.data('url-unread-message'),
        {},
        function($response) {},
        'json');
  },
  preAction: function($formData, $jqForm, $options) {
    $valid = $("#discussion--input-message").val().length > 0;
    $objDump = Object.assign({}, $formData[0]);
    $objDump.name = 'message_id_dump';
    $objDump.required = 'false';
    $objDump.type = 'hidden';  
    $objDump.value = messageIdDump;
    $formData.push($objDump);
    if ($valid) {
      $data = {
        id: messageIdDump,
        id_dump: messageIdDump,
        user_id: discussionData.data('user-id'),
        user_name: discussionData.data('user-name'),
        user_photo: discussionData.data('user-photo'),
        content: $("#discussion--input-message").val().replace(/\n\r?/g, '<br />'),
        created_at: new Date().toISOString(),
        type: 'text'
      };
      messageIdDump++;
      $(".discussion--input-text").first().val('');
      discussionGroup.append(Discussion.addMessage($data, $data.user_id));
      $('.time-humanize').each(function(index){
        $(this).timeago();
      });
      $('.discussion--messages').mCustomScrollbar('scrollTo', 'bottom', {
        scrollInertia: 1
      });
    }
    return $valid;
  },
  postAction : function($response, $status, $xhr, $form) {
    if ($response.status == 'ok') {
      $selector = $('[data-message-id-dump=' + $response.message_id_dump + ']');
      $selector.attr('data-message-id', $response.message_id);
      $selector.data('message-id', $response.message_id);
    }
  },
  addMessage : function($data, $userId) {
    $message = '';
    switch($data.type){
      case 'image':
        $message = Discussion.templateMessageImage($data, $userId);
        break;
      case 'video':
        $message = Discussion.templateMessageVideo($data, $userId);
        break;
      case 'file':
        $message = Discussion.templateMessageFile($data, $userId);
        break;
      default:
        $message = Discussion.templateMessageText($data, $userId);
    }
    return $message;
  },
  templateMessageText : function(data, userId, dump = true){
    $element = '';
    if (data.user_id == userId) {
      $element += '<li class="discussion--message current-user" data-message-id="' + data.id + '" data-message-id-dump="' + data.id_dump + '">';
    } else {
      $element += '<li class="discussion--message" data-message-id="' + data.id + '" data-message-id-dump="' + data.id_dump + '">';
    }
    $element += '<div class="discussion--message-info">';
    $element += '<span class="discussion--message-name">' + data.user_name + '</span>';
    $element += '<span class="discussion--message-timestamp time-humanize" title="' + new Date(data.created_at).toISOString() + '"></span>';
    $element += '</div>';
    $element += '<img class="discussion--message-avatar" src="' + data.user_photo + '" alt="' + data.user_name + '">';
    $element += '<div class="discussion--message-text--wrapper"><div class="discussion--message-text">' + data.content + '</div></div>';
    $element += '</li>';
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