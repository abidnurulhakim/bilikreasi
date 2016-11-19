@extends('layout.app')

@section('content')
  <div class="col-md-8 col-md-offset-2 col-sm-12">
    <div class="card">
      <div class="card-block">
        <div class="onl_login">
          <h3 class="text-center page-header">
            Masuk atau <a href="{{ route('home.register') }}" class="text-primary">Daftar</a>
          </h3>
          <div class="col-sm-12 text-center">
            <div class="col-xs-offset-3 col-sm-offset-3 col-xs-3 col-sm-3">
              <a href="#" class="btn btn-lg btn-block btn-social btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                <i class="fa fa-facebook fa-2x"></i>
                <span class="hidden-xs"></span>
              </a>
            </div>
            <div class="col-xs-3 col-sm-3">
              <a href="#" class="btn btn-lg btn-block btn-social btn-linkedin" data-toggle="tooltip" data-placement="top" title="LinkedIn">
                <i class="fa fa-linkedin fa-2x"></i>
                <span class="hidden-xs"></span>
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="col-xs-12 col-sm-offset-3 col-md-offset-3 col-sm-6 col-md-6 hr-custom">
              <hr class="hr-or">
              <span class="span-or">or</span>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            {!! Form::open(['route' => ['session.login'], 'method' => 'post']) !!}
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="input-group">
                <span class="input-group-addon btn-primary"><span class="fa fa-user fa-lg"></span></span>
                {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Masukkan Username/Email Anda']) !!}
              </div>
              <span class="help-block"></span>
              <div class="input-group">
                <span class="input-group-addon btn-primary"><span class="fa fa-lock fa-lg"></span></span>
                {!! Form::password('password', ['class' => 'form-control']) !!}
              </div>
              <br>
              <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Masuk</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection