<nav role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="{{ route('home.index') }}" class="brand-logo">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Bilikreasi">
    </a>
    <ul class="right hide-on-med-and-up menu-mobile">
      <li class="searchbox-mobile-icon"><i class="material-icons">search</i></li>
      <li><i class="fa fa-bell"></i></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      @include('layout.navigation.menu.category')
      @include('layout.navigation.menu.search')
      @include('layout.navigation.menu.user')
    </ul>
    <ul id="nav-mobile" class="side-nav">
      @include('layout.navigation.side')
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
@include('layout.navigation.menu.search_mobile')