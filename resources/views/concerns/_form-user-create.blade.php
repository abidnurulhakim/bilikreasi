{!! Form::model($user, ['route' => ['session.signup', $user->id], 'method' => 'post']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="form-group">
    {!! Form::label('username', 'Username') !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Username Anda']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('email', 'Alamat Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Alamat Email Anda']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Nama') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Anda']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('gender', 'Jenis Kelamin', ['class' =>'col-sm-12 form-label', 'style' => 'padding-left: 0']) !!}
    <div class="form-check">
      <label class="form-check-inline">
        {!! Form::radio('gender', 'male', $user->isMale()) !!} Laki-laki
      </label>
      <label class="form-check-inline">
        {!! Form::radio('gender', 'female', $user->isFemale()) !!} Perempuan
      </label>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('birthday', 'Tanggal Lahir') !!}
    {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('password_confirmation', 'Konfirmasi Password') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('term_agreement', 'Syarat & Ketentuan', ['class' =>'col-sm-12 form-label', 'style' => 'padding-left: 0']) !!}
    <div class="checkbox">
      <label class="form-check-inline">
        {!! Form::checkbox('term_agreement', '1') !!} You can see term and agreement in this <a href="#">term and agreement</a>
      </label>
    </div>
  </div>
  {!! Form::submit('Daftar', ['class' => 'btn btn-primary btn-lg']); !!}
{!! Form::close() !!}
