<div class="fixed-action-btn">
  <a class="btn-floating btn-large primary tooltipster" data-toggle="modal" data-target="#modalFeedback" data-placement="top" title="Feedback">
    <i class="fa fa-envelope fa-lg"></i>
  </a>
</div>
<!-- Modal -->
<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kritik, Saran dan Keluhan</h4>
      </div>
      {!! Form::open(['route' => 'feedback.store', 'method' => 'post', 'files' => true]) !!}
      <div class="modal-body">
        @if (isset($errors) && count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="form-group">
          {!! Form::label('name', 'Nama') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Anda', 'required' => true]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('email', 'Email') !!}
          {!! Form::email('email', (auth()->user() ? auth()->user()->email : null), ['class' => 'form-control', 'placeholder' => 'Masukkan Email Anda', 'required' => true]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('subject', 'Judul') !!}
          {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Judul', 'required' => true]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('content', 'Isi') !!}
          {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Isi', 'required' => true]) !!}
        </div>
        {!! Form::formFile('attachments', null, ['label' => 'Attachment (Gambar)', 'placeholder' => 'Attachment', 'data-max-file-count' => '5', 'data-max-file-size' => '20480', 'data-allowed-file-types' => '["image"]', 'multiple' => 'true'] ) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit('Kirim', ['class' => 'btn btn-primary']); !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>