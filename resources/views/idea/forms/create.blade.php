{!! Form::open(['route' => ['idea.store'], 'method' => 'POST', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formMaterializeText('title', null, ['label' => 'Judul', 'autofocus' => 'true'] ) !!}
  {!! Form::formTextEditor('description', null, ['label' => 'Deskripsi Ide', 'placeholder' => 'Deskripsi Idea'] ) !!}
  {!! Form::formFile('cover', null, ['label' => 'Gambar Cover Ide', 'placeholder' => 'Gambar Ide', 'data-max-file-count' => '1', 'data-max-file-size' => '2048', 'data-allowed-file-types' => '["image"]'] ) !!}
  {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, null, ['label' => 'Kategori Ide', 'placeholder' => 'Kategori Ide'] ) !!}
  <div class="show-cat-event hidden-xs-up">  
    {!! Form::formDateTimeLink('start_at', 'finish_at', null, null, ['label-start' => 'Waktu Mulai', 'label-finish' => 'Waktu Berakhir']) !!}
  </div>
  {!! Form::formTags('tags', $tags, null, ['label' => 'Tag Ide']) !!}
  {!! Form::formMaterializeText('location', null, ['label' => 'Lokasi', 'autofocus' => 'true'] ) !!}
  {!! Form::formSelect('status', \App\Models\Idea::STATUS, null, ['label' => 'Status Ide','placeholder' => 'Status Ide'] ) !!}
  {!! Form::formFile('media', null, ['label' => 'Gambar/Video', 'placeholder' => 'Gambar/Video', 'data-max-file-count' => '5', 'data-max-file-size' => '130048', 'data-allowed-file-types' => '["image", "video"]', 'multiple' => 'true'] ) !!}
  <hr>
  {!! Form::submit('Buat Ide', ['class' => 'btn btn-primary pull-right']); !!}
{!! Form::close() !!}
