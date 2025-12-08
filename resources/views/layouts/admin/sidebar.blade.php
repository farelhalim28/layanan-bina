<!-- FILE: resources/views/layouts/admin/sidebar.blade.php -->
<style>
    /* SIDEBAR MODERN STYLING */
    #sidebar {
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-right: 1px solid #e2e8f0;
        overflow-y: auto;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1001;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 4px 0 12px rgba(0, 0, 0, 0.04);
    }

    #sidebar.hide {
        transform: translateX(-280px);
    }

    .sidebar-wrapper {
        padding: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Header Logo */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 2px solid #f1f5f9;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .logo a {
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 14px;
        width: 100%;
    }

    .sidebar .logo-img {
    width: 120px !important;
    height: auto !important;
    max-width: 120px !important;
    object-fit: contain !important;
    display: block;
    }


    .logo img {
    max-width: 100%;
    height: auto;
    }


    .logo-text {
        display: flex;
        flex-direction: column;
    }

    .logo h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .logo p {
        margin: 2px 0 0 0;
        font-size: 10px;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Sidebar Menu */
    .sidebar-menu {
        flex: 1;
        padding: 20px 0;
        overflow-y: auto;
    }

    .sidebar-menu::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Sidebar Title */
    .sidebar-title {
        padding: 16px 24px 8px 24px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 1px;
        margin-top: 8px;
    }

    .sidebar-title:first-child {
        margin-top: 0;
    }

    /* Sidebar Item */
    .sidebar-item {
        margin: 0;
        padding: 0;
        transition: all 0.2s ease;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 24px;
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .sidebar-link i {
        font-size: 18px;
        width: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .sidebar-link span {
        flex: 1;
        transition: all 0.3s;
    }

    /* Hover State */
    .sidebar-item:not(.sidebar-title) .sidebar-link:hover {
        color: #667eea;
        padding-left: 32px;
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.08) 0%, transparent 100%);
    }

    .sidebar-item:not(.sidebar-title) .sidebar-link:hover i {
        transform: scale(1.1);
    }

    /* Active State */
    .sidebar-item.active .sidebar-link {
        color: white;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-weight: 700;
        border-radius: 12px;
        margin: 0 12px;
        padding-left: 20px;
        padding-right: 20px;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
    }

    .sidebar-item.active .sidebar-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 24px;
        background: white;
        border-radius: 0 4px 4px 0;
    }

    .sidebar-item.active .sidebar-link i {
        color: rgba(255, 255, 255, 0.95);
        transform: scale(1.15);
    }

    /* Logout Special Styling */
    .sidebar-item .sidebar-link.logout-link {
        color: #dc2626;
        margin: 16px 12px 0 12px;
        padding-left: 20px;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .sidebar-item .sidebar-link.logout-link:hover {
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, transparent 100%);
        color: #991b1b;
        padding-left: 32px;
    }

    .sidebar-item .sidebar-link.logout-link i {
        color: #dc2626;
    }

    /* Scrollbar Padding */
    .sidebar-menu {
        padding-right: 8px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        #sidebar {
            width: 260px;
        }

        #sidebar.hide {
            transform: translateX(-260px);
        }
    }

    @media (max-width: 768px) {
        #sidebar {
            position: fixed;
            width: 280px;
            height: 100vh;
            z-index: 999;
        }

        #sidebar.hide {
            transform: translateX(-280px);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        }

        .sidebar-header {
            padding: 20px 16px;
        }

        .sidebar-link {
            padding: 10px 16px;
            font-size: 13px;
        }

        .sidebar-title {
            padding: 12px 16px 6px 16px;
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        #sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
            height: auto;
            position: relative;
        }

        #sidebar.hide {
            transform: translateX(0);
        }

        .sidebar-menu {
            display: none;
        }

        .sidebar-menu.show {
            display: block;
        }
    }

    /* Overlay untuk mobile */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 998;
        display: none;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* Animation */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .sidebar-item {
        animation: slideInLeft 0.3s ease-out;
    }

    .sidebar-item:nth-child(n) {
        animation-delay: calc(0.05s * var(--index));
    }
</style>

<div id="sidebar" class="active">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar-wrapper active">
        {{-- Logo Header --}}
        <div class="sidebar-header">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('assets-admin/images/logo/unnamed.png') }}" alt="Logo Bina Desa" class="logo-img">
                    <div class="logo-text">
                        <h4>Bina Desa</h4>
                        <p>Layanan Mandiri</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Menu --}}
        <div class="sidebar-menu">
            <ul class="menu">
                {{-- Dashboard --}}
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="--index: 1;">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Menu Utama Title --}}
                <li class="sidebar-title">Menu Utama</li>

                {{-- Jenis Surat --}}
                <li class="sidebar-item {{ request()->routeIs('admin.jenis-surat.*') ? 'active' : '' }}" style="--index: 2;">
                    <a href="{{ route('admin.jenis-surat.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Jenis Surat</span>
                    </a>
                </li>

                {{-- Permohonan Surat --}}
                <li class="sidebar-item {{ request()->routeIs('admin.permohonan-surat.*') ? 'active' : '' }}" style="--index: 3;">
                    <a href="{{ route('admin.permohonan-surat.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-arrow-up-fill"></i>
                        <span>Permohonan Surat</span>
                    </a>
                </li>

                {{-- Berkas Persyaratan --}}
                <li class="sidebar-item {{ request()->routeIs('admin.berkas-persyaratan.*') ? 'active' : '' }}" style="--index: 4;">
                    <a href="{{ route('admin.berkas-persyaratan.index') }}" class='sidebar-link'>
                        <i class="bi bi-folder-fill"></i>
                        <span>Berkas Persyaratan</span>
                    </a>
                </li>

                {{-- Riwayat Status Surat --}}
                <li class="sidebar-item {{ request()->routeIs('admin.riwayat-status.*') ? 'active' : '' }}" style="--index: 5;">
                    <a href="{{ route('admin.riwayat-status.index') }}" class='sidebar-link'>
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Status</span>
                    </a>
                </li>

                {{-- Master Data Title --}}
                <li class="sidebar-title">Master Data</li>

                {{-- Data User --}}
                <li class="sidebar-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" style="--index: 6;">
                    <a href="{{ route('admin.user.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Data User</span>
                    </a>
                </li>

                {{-- Data Warga --}}
                <li class="sidebar-item {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}" style="--index: 7;">
                    <a href="{{ route('admin.warga.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Data Warga</span>
                    </a>
                </li>

                {{-- Media --}}
                <li class="sidebar-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" style="--index: 8;">
                    <a href="{{ route('admin.media.index') }}" class='sidebar-link'>
                        <i class="bi bi-image-fill"></i>
                        <span>Media</span>
                    </a>
                </li>

                {{-- Account Title --}}
                <li class="sidebar-title">Akun</li>

                {{-- Logout --}}
                <li class="sidebar-item" style="--index: 9;">
                    <a href="#" class="sidebar-link logout-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Toggle sidebar on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const burgerBtn = document.querySelector('.burger-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (burgerBtn) {
            burgerBtn.addEventListener('click', function() {
                sidebar.classList.toggle('hide');
                overlay.classList.toggle('show');
            });
        }

        // Close sidebar when overlay is clicked
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.add('hide');
                overlay.classList.remove('show');
            });
        }

        // Close sidebar when a link is clicked (mobile)
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('hide');
                    overlay.classList.remove('show');
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('hide');
                overlay.classList.remove('show');
            }
        });
    });
</script>
