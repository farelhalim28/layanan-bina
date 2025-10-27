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
</head>

<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('layouts.admin.sidebar')

        <div id="main">
            {{-- Header --}}
            @include('layouts.admin.header')

            {{-- Main Content --}}
            <main class="page-content">
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

    <style>
        /* Floating WhatsApp Button Styling */
        .float-whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 25px;
            right: 25px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            line-height: 60px; /* untuk menengahkannya vertikal */
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .float-whatsapp:hover {
            background-color: #20b358;
            transform: scale(1.1);
            color: #fff;
        }

        .float-whatsapp i {
            vertical-align: middle;
            display: inline-block;
        }
    </style>

    {{-- JS --}}
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/app.js') }}"></script>
</body>
</html>
