<!-- File: resources/views/layouts/admin/header.blade.php -->
<header class="mb-3 border-bottom bg-light py-2 px-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <a href="#" class="burger-btn d-block d-xl-none me-3">
            <i class="bi bi-justify fs-3"></i>
        </a>
        <h5 class="mb-0 text-primary fw-bold">Dashboard Admin</h5>
    </div>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-2 fs-4"></i>
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Logout</a></li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
        </ul>
    </div>
</header>
