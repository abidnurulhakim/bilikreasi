@extends('partner.layout')
@section('partner-content')
  <div class="col-xs-12 col-md-10 offset-md-1">
    <div class="card">
      <div class="card-panel search-panel">
        {!! Form::open(['route' => ['idea.search.partner', $idea], 'class' => 'card-text', 'method' => 'GET']) !!}
          <div class="materialize-input">
            <div class="input-field input-group">
              <i class="fa fa-search prefix"></i>
              {!! Form::text('name', app('request')->input('name', ''), ['placeholder' => 'Cari partner', 'autofocus' => 'autofocus']) !!}
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
                @if(!empty(app('request')->get('skills')) || !empty(app('request')->get('interests')))
                in
                @endif
                " id="advanced-search">
                  <div class="row">
                    <div class="col-xs-12" style="margin-top: 10px">
                      {!! Form::formTags('skills', $skills, $skillSelected, ['label' => 'Kemampuan', 'placeholder' => 'Kemampuan']) !!}
                    </div>
                    <div class="col-xs-12" style="margin-top: 10px">
                      {!! Form::formTags('interests', $interests, $interestSelected, ['label' => 'Minat', 'placeholder' => 'Minat']) !!}
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
    <div class="col-xs-12 grid">
      @forelse($users as $user)
        <div class="grid-item col-xs-12 col-md-4">
          @include('user.card', $user)
        </div>
      @empty
        <h4 class="text-xs-center text-muted">-- Tidak ada user yang ditemukan --</h4>
      @endforelse
    </div>
  </div>
  @if($users->hasMorePages())
    <div class="grid-item read-more hidden">
      <a href="{{ $users->nextPageUrl() }}"></a>
    </div>
  @endif
@endsection