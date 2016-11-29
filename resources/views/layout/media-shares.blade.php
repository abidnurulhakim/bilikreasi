<ul class="list-inline pull-right media-social">
  <li>
    <a href="https://www.facebook.com/dialog/feed?app_id={{ ENV('FACEBOOK_APP_ID') }}&display=popup&caption={{ urlencode($idea->title) }}&link={{ route('idea.show', $idea) }}&redirect_uri={{ route('idea.show', $idea) }}" target="_blank"">
      <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
      </span>
    </a>
  </li>
  <li>
    <a href="https://twitter.com/intent/tweet?text={{ urlencode(str_limit($idea->title, 100)) }}&url={{ urlencode(route('idea.show', $idea)) }}" class='twitter'>
      <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
      </span>
    </a>
  </li>
  <li>
    <a href="#" class='email'>
      <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
      </span>
    </a>
  </li>
</ul>