{!! Form::model($idea, ['route' => ['idea.update', $idea], 'method' => 'PUT', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="row">
    <div class="col-xs-12 text-xs-center col-md-3">
      {!! Form::cover('cover', $idea->getCover(), ['requeired' => true]) !!}
    </div>
    <div class="col-xs-12 col-md-9">
      {!! Form::formMaterializeText('title', null, ['label' => 'Judul', 'autofocus' => 'true'] ) !!}
      {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, null, ['label' => 'Kategori Ide'] ) !!}
      {!! Form::formSelect('status', \App\Models\Idea::STATUS, null, ['label' => 'Status Ide'] ) !!}
    </div>
    <div class="col-xs-12">
      {!! Form::formMaterializeTextEditor('description', $idea->description, ['label' => 'Deskripsi Ide', 'placeholder' => 'Deskripsi Idea'] ) !!}
      <div class="show-cat-event hidden-xs-up">
        {!! Form::formMaterializeDateTimeLink('start_at', 'finish_at', null, null, ['label-start' => 'Waktu Mulai', 'label-finish' => 'Waktu Berakhir']) !!}
      </div>
      {!! Form::formTags('tags', $tags, null, ['label' => 'Tag Ide']) !!}
      {!! Form::formMaterializeText('location', null, ['label' => 'Lokasi', 'autofocus' => 'true'] ) !!}
      {!! Form::formMaterializeDropzone('media', route('idea.media.store', $idea), ['label' => 'Gambar/Video', 'data-max-file-size' => '130048', 'data-accept-file-types' => 'image/*, video/*', 'multiple' => true] ) !!}
      <hr>
      {!! Form::submit('Buat Ide', ['class' => 'btn btn-primary pull-right']); !!}    
    </div>
  </div>
{!! Form::close() !!}
