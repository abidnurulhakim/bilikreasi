<li class="search-menu">
  @if(empty(app('request')->input('q')))
    {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox']) !!}
  @else
    {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox searchbox-open']) !!}
  @endif
    {!! Form::text('q', app('request')->input('q', ''), ['class' => 'searchbox-input', 'placeholder' => 'Cari Ide']) !!}
    <span class="input-group-btn searchbox-icon">
      <i class="fa fa-search"></i>
    </span>
  {!! Form::close() !!}
</li>