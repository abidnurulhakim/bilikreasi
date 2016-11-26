{!! Form::open(['route' => ['admin.idea.store'], 'method' => 'POST', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('title', null, ['label' => 'Judul Ide', 'placeholder' => 'Judul Ide', 'required' => true] ) !!}
  {!! Form::formTextEditor('description', null, ['label' => 'Deskripsi Ide', 'placeholder' => 'Deskripsi Idea', 'required' => true] ) !!}
  {!! Form::formFile('cover', null, ['label' => 'Gambar Cover Ide', 'placeholder' => 'Gambar Ide', 'data-max-file-count' => '1', 'data-max-file-size' => '2048', 'data-allowed-file-types' => '["image", "video"]', 'required' => true] ) !!}
  {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, null, ['label' => 'Kategori Ide', 'placeholder' => 'Kategori Ide', 'required' => true] ) !!}
  <div class="show-cat-event hidden">  
    {!! Form::formDateTimeLink('start_at', 'finish_at', null, null, ['label-start' => 'Waktu Mulai', 'label-finish' => 'Waktu Berakhir']) !!}
  </div>
  {!! Form::formTags('tags', $tags, null, ['label' => 'Tag Tambahan']) !!}
  {!! Form::formText('location', null, ['label' => 'Lokasi', 'placeholder' => 'Lokasi Ide Diadakan'] ) !!}
  {!! Form::formSelect('status', \App\Models\Idea::STATUS, null, ['label' => 'Status Ide','placeholder' => 'Status Ide', 'required' => true] ) !!}
  {!! Form::formFile('media', null, ['label' => 'Gambar/Video', 'placeholder' => 'Gambar/Video', 'data-max-file-count' => '5', 'data-max-file-size' => '10120', 'data-allowed-file-types' => '["image", "video"]', 'multiple' => 'true'] ) !!}
  <a href="{{ route('admin.idea.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
