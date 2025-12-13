<!-- FILE: resources/views/layouts/admin/header.blade.php -->
<header class="header-modern">
    {{-- Header Left --}}
    <div class="header-left">
        <button class="burger-btn d-block d-xl-none">
            <i class="bi bi-list"></i>
        </button>
        <h6 class="header-brand" >
            <i class="bi bi-house-fill" ></i>
            <span> Layanan Mandiri & Surat </span>
        </h6>
    </div>

    {{-- Header Right --}}
    <div class="header-right">
        {{-- Notification Icon --}}
        <button class="header-icon" title="Notifikasi">
            <i class="bi bi-bell-fill"></i>
            <span class="notification-badge">0</span>
        </button>

        {{-- User Profile Dropdown --}}
        <div class="user-profile-dropdown dropdown">
            <button class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle"
                    type="button"
                    id="dropdownUser1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="background: none; border: none; cursor: pointer;">
                <div class="user-avatar">
                    @php
                        $userName = session('user')->name ?? 'A';
                        echo strtoupper(substr($userName, 0, 1));
                    @endphp
                </div>
                <div class="user-info d-none d-sm-flex">
                    <p class="user-name">{{ session('user')->name ?? 'Admin' }}</p>
                    <p class="user-role">Administrator</p>
                </div>
            </button>

            {{-- Dropdown Menu --}}
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
                {{-- Welcome Section --}}
                <li class="px-3 py-2 text-center">
                    <p class="mb-0" style="font-size: 12px; color: #94a3b8; font-weight: 600;">
                        Selamat Datang
                    </p>
                    <p class="mb-0" style="font-size: 14px; color: #1e293b; font-weight: 700;">
                        {{ session('user')->name ?? 'Admin' }}
                    </p>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- Dashboard Link --}}
                <li>
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Master Data Links --}}
                <li>
                    <a class="dropdown-item" href="{{ route('admin.warga.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Data Warga</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                        <i class="bi bi-person-badge"></i>
                        <span>Data User</span>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- Information --}}
                <li>
                    <a class="dropdown-item" href="https://wa.me/6281234567890" target="_blank">
                        <i class="bi bi-question-circle"></i>
                        <span>Bantuan & Support</span>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- Logout --}}
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="dropdown-item logout" style="text-align: left;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
    // Burger menu toggle (untuk mobile)
    document.querySelector('.burger-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            sidebar.classList.toggle('show');
        }
    });

    // Close sidebar ketika item di-klik
    document.querySelectorAll('aside a').forEach(link => {
        link.addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            if (window.innerWidth < 1200 && sidebar) {
                sidebar.classList.remove('show');
            }
        });
    });
</script>
