<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-swatchbook"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="text-align: left">Perpusku</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ Route::is('admin.book.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.book.index') }}">
            <i class="fas fa-book"></i>
            <span>Buku</span></a>
    </li>

    <li class="nav-item {{ Route::is('admin.bookCategories.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.bookCategories.index') }}">
            <i class="fas fa-book-reader"></i>
            <span>Kategori Buku</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
