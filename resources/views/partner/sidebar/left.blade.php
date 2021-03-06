<div class="col-sm-4">
  <div class="box box-primary">
    <div class="box-body">
      {!! Form::open(['route' => ['idea.search.partner', $idea], 'class' => 'card-text', 'method' => 'GET']) !!}
      <form class="card-text">
        <div class="form-group">
          {{ Form::text('name', app('request')->input('name'), ['class' => 'form-control', 'type' => 'search', 'id' => 'search-input', 'aria-describedby' => 'search-input', 'placeholder' => 'Nama pengguna']) }}
          <small id="search-help" class="form-text text-muted">Contoh: "Joshua, Abid, Nurul, ..."</small>
        </div>
        <div class="form-group">
          {!! Form::formTags('skills', $skills, $skillSelected, ['label' => 'Kemampuan', 'placeholder' => 'Kemampuan']) !!}
        </div>
        <div class="form-group">
          {!! Form::formTags('interests', $interests, $interestSelected, ['label' => 'Minat', 'placeholder' => 'Minat']) !!}
        </div>
        <button type="submit" class="btn btn-primary btn-block">Cari</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>