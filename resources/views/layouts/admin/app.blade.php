<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bina Desa')</title>

    {{-- Fonts & CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">

    <style>
        /* Header User Alignment Fix */
        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-right: 1.5rem;
            font-weight: 600;
            color: #343a40;
        }
        .nav-user i {
            font-size: 1.25rem;
            vertical-align: middle;
            display: flex;
            align-items: center;
        }

        /* Floating WhatsApp Button Styling - FIXED */
        .float-whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .float-whatsapp:hover {
            background-color: #20b358;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.5);
            color: #fff;
        }

        .float-whatsapp i {
            font-size: 32px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Animasi Pulse untuk menarik perhatian */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        .float-whatsapp {
            animation: pulse 2s infinite;
        }

        .float-whatsapp:hover {
            animation: none;
        }
    </style>
</head>

<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('layouts.admin.sidebar')

        <div id="main">
            {{-- Header --}}
            <header class="d-flex justify-content-end align-items-center p-3 border-bottom bg-white shadow-sm">
                <div class="nav-user">
                    <i class="bi bi-person-circle"></i>
                    <span>Admin</span>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="page-content p-4">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layouts.admin.footer')
        </div>
    </div>

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/6281234567890"
       target="_blank"
       class="float-whatsapp"
       title="Hubungi Kami di WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    {{-- JS --}}
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/app.js') }}"></script>
</body>
</html>
