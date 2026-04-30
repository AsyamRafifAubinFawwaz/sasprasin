<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('_admin._layout.favicon')

    <title>{{ env('APP_ENV') == 'local' ? '[LOCAL] ' : '' }}SARPRASIN - @yield('title')</title>

    <meta name="description" content="@yield('description', 'Sistem manajemen sarana prasarana sekolah')">

    <meta name="keywords" content="sarpras sekolah, manajemen sarana prasarana, aplikasi sarpras">

    <meta name="robots" content="index, follow">

    <meta name="author" content="Sarprasin">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://preline.co/assets/js/hs-datepicker.min.js"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin-custom.css', 'resources/js/admin-custom.js'])

    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    @include('_landing._layout.navbar')

    <!-- Content -->
    <div class="w-full ">
        <div id="main-content" class="">
            @if (session('success'))
                <div id="spa-flash-success" style="display: none;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div id="spa-flash-error" style="display: none;">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
    <!-- End Content -->
    @include('_landing._layout.footer')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- NProgress -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <!-- Smooth Scroll for Landing Page -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for buttons with smooth-scroll class
            document.querySelectorAll('.smooth-scroll').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);

                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic',
            offset: 50,
        });
    </script>

    @stack('scripts')

</body>

</html>
