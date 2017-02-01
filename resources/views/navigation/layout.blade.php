<nav role="navigation">
  <div class="nav nav-wrapper container">
    <a id="logo-container" href="{{ route('home.index') }}" class="brand-logo">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Bilikreasi">
    </a>
    <a href="#" data-activates="nav-mobile" class="button-collapse">
      <i class="fa fa-bars"></i>
    </a>
    @include('navigation.main.mobile.layout')
    @include('navigation.main.desktop.layout')
    @include('navigation.side.mobile.layout')
  </div>
</nav>
@include('navigation.menu.mobile.search')