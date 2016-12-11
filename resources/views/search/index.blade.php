@extends('search.layout')
@section('search-content')
  <div class="col-sm-10 col-sm-offset-1">
    <div class="card">
      <div class="card-block">
        {!! Form::open(['route' => ['search.index'], 'class' => 'card-text', 'method' => 'GET']) !!}
          <div class="search-input col-padding">
            <div class="input-group col-sm-12">
              {!! Form::text('q', app('request')->input('q', ''), ['class' => 'form-control', 'placeholder' => 'Cari Ide']) !!}
              <span class="input-group-btn">
                <button type='submit' class="btn btn-lg" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </div>
          <div class="collapse 
          @if(!empty(app('request')->get('category')) || !empty(app('request')->get('status')) || !empty(app('request')->get('tags')))
          in
          @endif
          " id="advanced-search">
            <div class="col-sm-6">
              {{ Form::select('category', \App\Models\Idea::CATEGORY, app('request')->get('category'), ['class' => 'form-control', 'style' => 'width: 100%', 'placeholder' => 'Kategori Ide']) }}
            </div>
            <div class="col-sm-6">
              {!! Form::select('status', \App\Models\Idea::STATUS, app('request')->get('status'), ['class' => 'form-control', 'style' => 'width: 100%', 'placeholder' => 'Status Ide']) !!}
            </div>
            <div class="col-sm-12" style="margin-top: 10px">
              {!! Form::formTags('tags', $tags, app('request')->get('tags', []), ['label' => 'Tag Ide', 'placeholder' => 'Tag Ide']) !!}
            </div>
          </div>
          <button class="btn btn-xs btn-primary pull-right advanced-search" type="button" data-toggle="collapse" data-target="#advanced-search" aria-expanded="false" aria-controls="advanced-search">
            <i class="fa fa-gears"></i> Pengaturan pencarian
          </button>
        {!! Form::close() !!}  
      </div>
    </div>  
  </div>
  <div class="grid col-sm-12 no-padding">
    @forelse($ideas as $idea)
      <div class="grid-item col-sm-3 col-padding">
        @include('idea.card', $idea)
      </div>
    @empty
      <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
    @endforelse
  </div>
  @if($ideas->hasMorePages())
    <div class="grid-item read-more hidden">
      <a href="{{ $ideas->nextPageUrl() }}"></a>
    </div>
  @endif
@endsection