{!! Form::model($feedback, ['route' => ['admin.feedback.reply.store', $feedback], 'method' => 'POS']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('name', null, ['label' => 'Name Sender', 'placeholder' => 'Nama Pengirim', 'disabled' => true] ) !!}
  {!! Form::formEmail('email', null, ['label' => 'Email Sender', 'placeholder' => 'Email Pengirim', 'disabled' => true] ) !!}
  {!! Form::formText('subject', null, ['label' => 'Feeback Subject', 'placeholder' => 'Judul Feedback', 'disabled' => true] ) !!}
  {!! Form::formTextArea('content', null, ['label' => 'Feeback Content', 'placeholder' => 'Isi Feedback', 'disabled' => true] ) !!}
  <div class="form-group">
    <div class="col-md-12 no-padding">
      {!! Form::label('attachments', 'Attachments') !!}
    </div>
    @forelse($feedback->attachments as $attachment)
      <div class="col-md-4 no-padding">
        <img src="{{ asset($attachment->url) }}" class="responsive">
      </div>
    @empty
      <div class="text-muted col-md-12">No attachments.</div>
    @endforelse  
  </div>
  <div class="col-md-12"></div>
  <br><br><br><br><br><br><br><br><br><br><br><br>
  {!! Form::formTextEditor('reply_content', null, ['label' => 'Feedback Reply', 'placeholder' => 'Reply', 'required' => true] ) !!}
  <a href="{{ route('admin.feedback.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Reply', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
