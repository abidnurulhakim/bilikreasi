@extends('layout.app')

@section('content')
  <div class="row">
    <div class="col s12 m8 offset-m2">
      <div class="card">
        <div class="card-panel">
          <div class="col s12 m12 center-align">
            <div class="col s12 m6 offset-m3">
              <a class="btn btn-flat btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
                <i class="fa fa-facebook"></i> Daftar dengan Facebook
              </a>
            </div>
            <div class="col s12 m6 offset-m3">
              <a class="btn btn-flat btn-block btn-social btn-google-plus" href="{{ route('auth.social.google') }}">
                <i class="fa fa-google"></i> Daftar dengan Google+
              </a>
            </div>
          </div>
          <div class="col s12 m12">
            <div class="col s12 m12 hr-custom">
              <hr class="hr-or">
              <span class="span-or">atau</span>
            </div>
          </div>
          <div class="col s12 m12">
            @include('concerns._form-user-register')    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection