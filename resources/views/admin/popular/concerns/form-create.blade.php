{!! Form::open(['route' => ['admin.popular.store'], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('title', null, ['label' => 'Title Popular', 'placeholder' => 'Title Popular', 'required' => true] ) !!}
  {!! Form::formNumber('order_number', null, ['label' => 'Order Number', 'placeholder' => 'Order Number'] ) !!}
  {!! Form::formSelect('publish', ['Not Publish', 'Publish'], null, ['label' => 'Publish'] ) !!}
  <a href="{{ route('admin.popular.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
