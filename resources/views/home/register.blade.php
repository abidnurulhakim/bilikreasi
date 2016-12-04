@extends('layout.app')

@section('content')
  <h3 class="page-header">
    <b class="title">Daftar</b>
  </h3>
  <div class="box box-primary">
    <div class="box-body">
      <div class="col-sm-12 text-center">
        <div class="col-xs-offset-4 col-sm-offset-4 col-xs-4 col-sm-4">
          <a class="btn btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
            <i class="fa fa-facebook"></i> Daftar dengan Facebook
          </a>
        </div>
      </div>
      <br><br>
      <div class="col-sm-12 text-center">
        <div class="col-xs-offset-4 col-sm-offset-4 col-xs-4 col-sm-4">
          <a class="btn btn-block btn-social btn-google" href="{{ route('auth.social.google') }}">
            <i class="fa fa-google"></i> Daftar dengan Google
          </a>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="col-xs-12 col-sm-12 hr-custom">
          <hr class="hr-or">
          <span class="span-or">or</span>
        </div>
      </div>
      <div class="col-sm-12">
        @include('concerns._form-user-register')    
      </div>
    </div>
  </div>
@endsection