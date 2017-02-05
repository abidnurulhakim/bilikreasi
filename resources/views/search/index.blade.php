@extends('search.layout')
@section('search-content')
  <div class="col-xs-12 col-md-10 offset-md-1">
    <div class="card">
      <div class="card-panel search-panel">
        {!! Form::open(['route' => ['search.index'], 'class' => 'card-text', 'method' => 'GET']) !!}
          <div class="materialize-input">
            <div class="input-field input-group">
              <i class="fa fa-search prefix"></i>
              {!! Form::text('q', app('request')->input('q', ''), ['placeholder' => 'Cari Ide', 'autofocus' => 'autofocus']) !!}
              <span class="input-group-btn">
                {!! Form::submit('Cari', ['class' => 'btn btn-primary btn-flat']) !!}
              </span>
            </div>
          </div>
            
          <div class="row">
            <div class="col-xs-12 advanced-search">
              <a class="btn btn-sm btn-flat btn-primary pull-right" data-toggle="collapse" data-target="#advanced-search" aria-expanded="false" aria-controls="advanced-search">
                <i class="fa fa-gears"></i> Saring pencarian
              </a>
            </div>
            <div class="col-xs-12">
              <div class="collapse 
                @if(!empty(app('request')->get('category')) || !empty(app('request')->get('status')) || !empty(app('request')->get('tags')))
                in
                @endif
                " id="advanced-search">
                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                      {{ Form::select('category', \App\Models\Idea::CATEGORY, app('request')->get('category'), ['class' => 'form-control', 'style' => 'width: 100%', 'placeholder' => 'Kategori Ide']) }}
                    </div>
                    <div class="col-xs-12 col-md-6">
                      {!! Form::select('status', \App\Models\Idea::STATUS, app('request')->get('status'), ['class' => 'form-control', 'style' => 'width: 100%', 'placeholder' => 'Status Ide']) !!}
                    </div>
                    <div class="col-xs-12" style="margin-top: 10px">
                      {!! Form::formTags('tags', $tags, app('request')->get('tags', []), ['label' => 'Tag Ide', 'placeholder' => 'Tag Ide']) !!}
                    </div>  
                  </div>
                </div>
            </div>
          </div>
        {!! Form::close() !!}  
      </div>
    </div>
  </div>
  <div class="row">
    @forelse($ideas as $idea)
      <div class="col-xs-12 grid">
        <div class="grid-item col-xs-12 col-md-4">
          @include('idea.card', $idea)
        </div>
      </div>
    @empty
      <div class="col-xs-12 col-md-8 offset-md-2">
        <div class="card z-depth-2">
          <div class="card-panel">
            <h4 class="text-xs-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
          </div>
        </div>
      </div>
    @endforelse
  </div>
  @if($ideas->hasMorePages())
    <div class="grid-item read-more hidden">
      <a href="{{ $ideas->nextPageUrl() }}"></a>
    </div>
  @endif
@endsection