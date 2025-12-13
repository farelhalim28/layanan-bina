<!-- FILE: resources/views/layouts/admin/app.blade.php -->
<!--
    Template Name: Mazer Admin Dashboard
    URL: https://github.com/zuramai/mazer
    Author: Zuraiz
    License: MIT License
-->

<!-- FILE: resources/views/layouts/admin/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Layanan Mandiri & Surat')</title>

    {{-- Fonts & CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            color: #1e293b;
        }

        #app {
            display: flex;
            min-height: 100vh;
        }

        #main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        }

        .page-content {
            flex: 1;
            overflow-y: auto;
            overflow-x: visible;
            position: relative;
            padding: 20px;
        }

        /* HEADER MODERN STYLE */
        .header-modern {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 100;
            margin: 20px 20px 0 20px;
            border-radius: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-brand {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-brand i {
            font-size: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .burger-btn {
            display: none;
            background: none;
            border: none;
            color: #667eea;
            cursor: pointer;
            font-size: 24px;
            transition: all 0.3s;
        }

        .burger-btn:hover {
            color: #764ba2;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        /* Notification Icon */
        .header-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 18px;
            position: relative;
        }

        .header-icon:hover {
            background: #667eea;
            color: white;
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ef4444;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        /* User Profile Dropdown */
        .user-profile-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-avatar:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .user-role {
            font-size: 12px;
            color: #94a3b8;
            margin: 0;
        }

        .dropdown-toggle::after {
            margin-left: 8px;
            color: #667eea;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            padding: 8px;
            margin-top: 12px;
            animation: slideDown 0.2s ease-out;
            z-index: 10000 !important;
            position: absolute !important;
        }

        .dropdown-menu.show {
            display: block !important;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
            color: #667eea;
        }

        .dropdown-item i {
            font-size: 16px;
        }

        .dropdown-divider {
            margin: 6px 0;
            border-color: #e2e8f0;
        }

        .dropdown-item.logout {
            color: #ef4444;
        }

        .dropdown-item.logout:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Floating WhatsApp Button */
        .float-whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #25D366 0%, #20b358 100%);
            color: #fff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: none;
        }

        .float-whatsapp:hover {
            background: linear-gradient(135deg, #20b358 0%, #1a8c43 100%);
            transform: scale(1.12) translateY(-8px);
            box-shadow: 0 12px 32px rgba(37, 211, 102, 0.5);
            color: #fff;
        }

        .float-whatsapp i {
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

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

        /* Responsive */
        @media (max-width: 768px) {
            .header-modern {
                padding: 12px 16px;
                margin: 10px;
                border-radius: 16px;
            }

            .page-content {
                padding: 15px;
            }

            .header-brand {
                font-size: 16px;
            }

            .burger-btn {
                display: block;
            }

            .user-info {
                display: none;
            }

            .header-right {
                gap: 12px;
            }

            .float-whatsapp {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }

            .float-whatsapp i {
                font-size: 24px;
            }
        }
    </style>
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

    {{-- JS --}}
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/app.js') }}"></script>

</body>
</html>
