<li class="category-menubar">
  <a class='popover btn primary' href='#' data-placement="bottom">Kategory</a>
  <div class="webui-popover-content">
    <ul>
      <a href="{{ route('search.index', ['category' => 'bussiness']) }}">
        <li><i class="fa fa-money"></i> Usaha</li>
      </a>
      <a href="{{ route('search.index', ['category' => 'community']) }}">
        <li><i class="fa fa-users"></i> Komunitas</li>
      </a>
      <a href="{{ route('search.index', ['category' => 'campaign']) }}">
        <li><i class="fa fa-bullhorn"></i> Kampanye</li>
      </a>
      <a href="{{ route('search.index', ['category' => 'project']) }}">
        <li><i class="fa fa-suitcase"></i> Proyek</li>
      </a>
      <a href="{{ route('search.index', ['category' => 'event']) }}">
        <li><i class="fa fa-calendar"></i> Kegiatan</li>
      </a>
      <a href="{{ route('search.index', ['category' => 'other']) }}">
        <li><i class="fa fa-bars"></i> Lain</li>
      </a>
    </ul>
  </div>
</li>