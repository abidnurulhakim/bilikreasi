<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ auth()->user()->getPhoto(160) }}" class="img-circle" alt="{{ auth()->user()->name }}">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li @if(isset($userMenu)) class="active" @endif>
        <a href="{{ route('admin.user.index') }}">
          <i class="fa fa-users"></i> <span>User</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($ideaMenu)) class="active" @endif>
        <a href="{{ route('admin.idea.index') }}">
          <i class="fa fa-lightbulb-o"></i> <span>Idea</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($bannerMenu)) class="active" @endif>
        <a href="{{ route('admin.user.index') }}">
          <i class="fa fa-bullhorn"></i> <span>Banner</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($popularMenu)) class="active" @endif>
        <a href="{{ route('admin.user.index') }}">
          <i class="fa fa-bookmark"></i> <span>Popular</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($tagMenu)) class="active" @endif>
        <a href="{{ route('admin.tag.index') }}">
          <i class="fa fa-tags"></i> <span>Tag</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($interestMenu)) class="active" @endif>
        <a href="{{ route('admin.interest.index') }}">
          <i class="fa fa-heart"></i> <span>Interest</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li @if(isset($skillMenu)) class="active" @endif>
        <a href="{{ route('admin.skill.index') }}">
          <i class="fa fa-gears"></i> <span>Skill</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>