<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}">
                    <h4 class="text-primary">🏘️ Bina Desa</h4>
                </a>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.warga.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i><span>Data Warga</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.jenis-surat.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.jenis-surat.index') }}" class='sidebar-link'>
                        <i class="bi bi-folder-fill"></i><span>Jenis Surat</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i><span>Data User</span>
                    </a>
                </li>

                <li class="sidebar-title">Akun</li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>
