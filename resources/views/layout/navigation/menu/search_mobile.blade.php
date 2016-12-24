@if(empty(app('request')->input('q')))
  {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox-mobile hide-on-med-and-up']) !!}
@else
  {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox-mobile hide-on-med-and-up open']) !!}
@endif
  {!! Form::text('q', app('request')->input('q', ''), ['class' => 'searchbox-mobile-input', 'placeholder' => 'Cari Ide']) !!}
  <span class="input-group-btn searchbox-mobile-icon-submit">
    <i class="fa fa-search" type="submit"></i>
  </span>
{!! Form::close() !!}