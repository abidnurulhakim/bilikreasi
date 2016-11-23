<div class="col-md-4">
  <div class="card">
    <div class="card-block">
      {!! Form::open(['route' => ['idea.search.partner', $idea], 'class' => 'card-text', 'method' => 'GET']) !!}
      <form class="card-text">
        <div class="form-group">
          {{ Form::text('name', app('request')->input('name'), ['class' => 'form-control', 'type' => 'search', 'id' => 'search-input', 'aria-describedby' => 'search-input', 'placeholder' => 'Nama pengguna']) }}
          <small id="search-help" class="form-text text-muted">Contoh: "Joshua, Abid, Nurul, ..."</small>
        </div>
        <div class="form-group">
          {!! Form::formSelect('skill[]', $skills, ['label' => 'Kemampuan', 'placeholder' => 'Kemampuan', 'multiple' => 'true', 'selected' => $skillSelected]) !!}
        </div>
        <div class="form-group">
          {!! Form::formSelect('interest[]', $interests, ['label' => 'Minat', 'placeholder' => 'Minat', 'multiple' => 'true', 'selected' => $interestSelected] ) !!}
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>