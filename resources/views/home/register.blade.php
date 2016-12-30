@extends('layout.app')

@section('content')
  <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1">
    <div class="card">
      <div class="card-panel">
        <div class="col-xs text-xs-center">
          <div class="col-xs col-md-6 offset-md-3">
            <a class="btn btn-flat btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
              <i class="fa fa-facebook"></i> Daftar dengan Facebook
            </a>
          </div>
          <div class="col-xs col-md-6 offset-md-3">
            <a class="btn btn-flat btn-block btn-social btn-google-plus" href="{{ route('auth.social.google') }}">
              <i class="fa fa-google"></i> Daftar dengan Google
            </a>
          </div>
        </div>

        <div class="col-xs">
          <div class="col-xs hr-custom">
            <hr class="hr-or">
            <span class="span-or">atau</span>
          </div>
        </div>

        <div class="col-xs">
          @include('concerns._form-user-register')    
        </div>
      </div>
    </div>
  </div>
@endsection