<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bina Desa')</title>

    {{-- Include CSS --}}
    @include('layout.admin.css')
</head>

<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('layout.admin.sidebar')

        <div id="main">
            {{-- Header --}}
            @include('layout.admin.header')

            {{-- Main Content --}}
            <main class="page-content">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layout.admin.footer')
        </div>
    </div>

    {{-- Include JS --}}
    @include('layout.admin.js')
</body>
</html>
