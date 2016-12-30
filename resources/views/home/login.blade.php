@extends('layout.app')

@section('content')
  <div class="col-xs-12 col-sm-12 col-md-8 offset-md-2">
    <div class="card">
      <div class="card-panel">
        <h5 class="text-xs-center">
          Masuk atau <a href="{{ route('home.register') }}">Daftar</a>
        </h5>
        <div class="col-xs text-xs-center">
          <div class="col-xs col-md-6 offset-md-3">
            <a class="btn btn-flat btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
              <i class="fa fa-facebook"></i> Masuk dengan Facebook
            </a>
          </div>
          <div class="col-xs col-md-6 offset-md-3">
            <a class="btn btn-flat btn-block btn-social btn-google-plus" href="{{ route('auth.social.google') }}">
              <i class="fa fa-google"></i> Masuk dengan Google
            </a>
          </div>
        </div>
        <div class="col-xs">
          <div class="col-xs hr-custom">
            <hr class="hr-or">
            <span class="span-or">atau</span>
          </div>
        </div>
        <div class="col-xs col-md-10 offset-md-1">
          @include('concerns._form-user-login')
        </div>
      </div>
    </div>
  </div>
@endsection