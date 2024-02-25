<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.home') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Home</span>
        </a>
      </li>
      @auth('admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('accounts.index') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Kepegawaian</span>
          </a>
      </li>
      @endauth
    </ul>
  </nav>