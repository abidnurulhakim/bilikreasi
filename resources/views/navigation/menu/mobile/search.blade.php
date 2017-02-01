{!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox-mobile hidden-sm-up']) !!}
  <div class="form-group">
  	{!! Form::text('q', app('request')->input('q', ''), ['class' => 'searchbox-mobile-input', 'placeholder' => 'Cari Ide']) !!}
  	<i class="action-search fa fa-search"></i>
  </div>  
{!! Form::close() !!}