{!! Form::model($banner, ['route' => ['admin.banner.update', $banner], 'method' => 'PUT', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('title', null, ['label' => 'Title Banner', 'placeholder' => 'Title Banner', 'required' => true] ) !!}
  {!! Form::formTextArea('description', null, ['label' => 'Description Banner', 'placeholder' => 'Description Banner'] ) !!}
  {!! Form::formText('url', null, ['label' => 'URL Banner', 'placeholder' => 'URL Banner']) !!}
  {!! Form::formFile('image', null, ['label' => 'Image Banner', 'placeholder' => 'Image Banner', 'data-initial-preview-url' => '["'.$banner->getImage().'"]', 'data-max-file-count' => '1', 'data-max-file-size' => '5120', 'data-allowed-file-types' => '["image"]'] ) !!}
  {!! Form::formDateTimeLink('start_at', 'finish_at', $banner->start_at, $banner->finish_at, ['label-start' => 'Started At', 'label-finish' => 'Finished At']) !!}
  {!! Form::formNumber('order_number', null, ['label' => 'Order Number', 'placeholder' => 'Order Number']) !!}
  {!! Form::formSelect('publish', ['Not Publish', 'Publish'], $banner->publish, ['label' => 'Publish']) !!}
  <a href="{{ route('admin.banner.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
