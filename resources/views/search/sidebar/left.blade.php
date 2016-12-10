<div class="col-sm-4">
  <div class="box box-primary">
    <div class="box-body">
      {!! Form::open(['route' => ['search.index'], 'class' => 'card-text', 'method' => 'GET']) !!}
        <div class="form-group">
          {{ Form::text('q', app('request')->input('q'), ['class' => 'form-control', 'type' => 'search', 'id' => 'search-input', 'aria-describedby' => 'search-input', 'placeholder' => 'Pencaharian Ide']) }}
          <small id="search-help" class="form-text text-muted">Contoh: "Photograph, Web Developer, ..."</small>
        </div>
        <div class="form-group">
          {!! Form::formTags('tags', $tags, $tagSelected, ['label' => 'Tag Ide', 'placeholder' => 'Tag Ide']) !!}
        </div>
        <div class="form-group">
          {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, app('request')->input('category'), ['label' => 'Kategori Ide', 'placeholder' => 'Kategori Ide'] ) !!}
        </div>
        <div class="form-group">
          {!! Form::formSelect('status', \App\Models\Idea::STATUS, app('request')->input('status'), ['label' => 'Status Ide', 'placeholder' => 'Status Ide'] ) !!}
        </div>
        <button type="submit" class="btn btn-primary btn-block">Cari</button>
      {!! Form::close() !!}
    </div>
  </div>
</div>