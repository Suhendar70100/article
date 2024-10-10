<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        <li class="menu-item @if (Request::is('article')) active @endif ">
          <a href="{{ route('article') }}" class="menu-link">
              <i class="menu-icon tf-icons mdi mdi-folder"></i>
              <div data-i18n="Artikel">Artikel</div>
          </a>
      </li>

      <li class="menu-item">
        <a href="#" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="mdi mdi-logout me-2"></i>
            <div data-i18n="Transaksi">Log Out</div>
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
      
      </ul>
    </div>
  </aside>