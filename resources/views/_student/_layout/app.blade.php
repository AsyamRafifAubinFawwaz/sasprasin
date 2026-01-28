<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('_admin._layout.favicon')

    <title>{{ env('APP_ENV') == 'local' ? '[LOCAL] ' : '' }}Laravel Starter Kit - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin-custom.css', 'resources/js/admin-custom.js'])

    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

</head>

<body>
    @include('_layout.header')

    @include('_layout.sidebar')

    <!-- Content -->
    <div class="w-full lg:ps-64 bg-white dark:bg-neutral-900 min-h-screen">
        <div id="main-content" class="p-2 2xl:px-25 px-3 md:px-8 pt-24 lg:pt-10 sm:p-6 space-y-4 sm:space-y-6">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- NProgress -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>


    @stack('scripts')
 <script>
        function initSidebar() {
            const body = document.body;
            const sidebar = document.getElementById('hs-application-sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');

            if (!sidebar) return;

            // Helper to set state
            function setSidebarState(isCollapsed) {
                // Set the data attribute - CSS handles the rest!
                body.setAttribute('data-sidebar-collapsed', isCollapsed);
                localStorage.setItem('sidebar-collapsed', isCollapsed);
            }

            // Bind Toggle Click
            // We use a cloning trick or just replace listener to ensure no duplicates
            const newBtn = toggleBtn.cloneNode(true);
            toggleBtn.parentNode.replaceChild(newBtn, toggleBtn);

            newBtn.addEventListener('click', function () {
                const isCollapsed = body.getAttribute('data-sidebar-collapsed') === 'true';
                setSidebarState(!isCollapsed);
            });

            // Apply initial state
            const savedState = localStorage.getItem('sidebar-collapsed') === 'true';
            setSidebarState(savedState);
        }

        // Initialize on load and on Livewire navigation
        document.addEventListener('DOMContentLoaded', initSidebar);
        document.addEventListener('livewire:navigated', initSidebar);
    </script>
</body>

</html>