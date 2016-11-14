<div class="col-md-4">
  <div class="card">
    <div class="card-block">
      {!! Form::open(['route' => ['search.index'], 'class' => 'card-text', 'method' => 'GET']) !!}
      <form class="card-text">
        <div class="form-group">
          {{ Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'type' => 'search', 'id' => 'search-input', 'aria-describedby' => 'search-input', 'placeholder' => 'Pencaharian Ide']) }}
          <small id="search-help" class="form-text text-muted">Contoh: "Photograph, Web Developer, ..."</small>
        </div>
        <div class="form-group">
          {!! Form::formSelect('tag', $tags, ['label' => 'Tag Ide', 'placeholder' => 'Tag Ide', 'selected' => app('request')->input('tag')] ) !!}
        </div>
        <div class="form-group">
          {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, ['label' => 'Kategori Ide', 'placeholder' => 'Kategori Ide', 'selected' => app('request')->input('category')] ) !!}
        </div>
        <!-- <div class="form-group">
          <label for="exampleSelect1">Lokasi</label>
          <select class="form-control form-control-lg" id="exampleSelect1">
            <option>Semua Lokasi</option>
            <option>Bandung</option>
            <option>Jakarta</option>
            <option>Surabaya</option>
            <option>Jawa Barat</option>
          </select>
        </div> -->
        <button type="submit" class="btn btn-primary">Cari</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>