<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0B2F8A !important">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-icon">
        <i class="fas fa-swatchbook"></i>
    </div>
    <div class="sidebar-brand-text mx-3" style="text-align: left">Perpusku</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Route::is('user.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('user.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>
  <li class="nav-item {{ Route::is('user.profile') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('user.profile') }}">
          <i class="fas fa-user"></i>
          <span>Profil Saya</span></a>
  </li>

  <li class="nav-item {{ Route::is('user.book.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.book.index') }}">
        <i class="fas fa-book"></i>
        <span>Buku</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-power-off"></i>
        <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>
<!-- End of Sidebar -->
