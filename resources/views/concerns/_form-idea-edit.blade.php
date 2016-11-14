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
  {!! Form::formText('title', null, ['label' => 'Judul Ide', 'placeholder' => 'Judul Ide', 'required' => true] ) !!}
  {!! Form::formTextEditor('description', $idea->description, ['label' => 'Deskripsi Ide', 'placeholder' => 'Deskripsi Idea', 'required' => true] ) !!}
  {!! Form::formFile('cover', null, ['label' => 'Gambar Cover Ide', 'placeholder' => 'Gambar Ide', 'data-initial-preview-url' => '["'.$idea->getCover().'"]', 'data-max-file-count' => '1', 'data-max-file-size' => '2048', 'data-allowed-file-types' => '["image", "video"]'] ) !!}
  {!! Form::formSelect('category', \App\Models\Idea::CATEGORY, ['label' => 'Kategori Ide','placeholder' => 'Kategori Ide', 'selected' => $idea->category, 'required' => true] ) !!}
  <div class="show-cat-event
  @if($idea->category != 'event')
  hidden
  @endif
  ">
    {!! Form::formDateTimeLink('start_at', 'finish_at', $idea->start_at, $idea->finish_at, ['label-start' => 'Waktu Mulai', 'label-finish' => 'Waktu Berakhir']) !!}
  </div>
  {!! Form::formTags('tag', $ideaTags, ['label' => 'Tag Ide', 'collection' => $tags, 'required' => true]) !!}
  {!! Form::formText('location', null, ['label' => 'Lokasi', 'placeholder' => 'Lokasi Ide Diadakan', 'required' => true] ) !!}
  {!! Form::formSelect('status', \App\Models\Idea::STATUS, ['label' => 'Status Ide','placeholder' => 'Status Ide', 'selected' => $idea->status] ) !!}
  {!! Form::formFile('media', null, ['label' => 'Gambar/Video', 'placeholder' => 'Gambar/Video', 'data-max-file-count' => '5', 'data-max-file-size' => '10120', 'data-allowed-file-types' => '["image", "video"]', 'multiple' => 'true'] ) !!}
  {!! Form::submit('Perbaharui Ide', ['class' => 'btn btn-primary btn-lg']); !!}
{!! Form::close() !!}
