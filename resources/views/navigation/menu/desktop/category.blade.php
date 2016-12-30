<li class="category-menu">
  <a class='popover' href='#' data-animation="fade" data-placement="bottom" data-trigger='hover'>Kategory <i class="fa fa-caret-down"></i></a>
  <div class="webui-popover-content">
    <ul class="dropdown-menu">
      <a href="{{ route('search.index', ['category' => 'bussiness']) }}">
        <i class="fa fa-money"></i> Usaha
      </a>
      <a href="{{ route('search.index', ['category' => 'community']) }}">
        <i class="fa fa-users"></i> Komunitas
      </a>
      <a href="{{ route('search.index', ['category' => 'campaign']) }}">
        <i class="fa fa-bullhorn"></i> Kampanye
      </a>
      <a href="{{ route('search.index', ['category' => 'project']) }}">
        <i class="fa fa-suitcase"></i> Proyek
      </a>
      <a href="{{ route('search.index', ['category' => 'event']) }}">
        <i class="fa fa-calendar"></i> Kegiatan
      </a>
      <a href="{{ route('search.index', ['category' => 'other']) }}">
        <i class="fa fa-bars"></i> Lain
      </a>
    </ul>
  </div>
</li>