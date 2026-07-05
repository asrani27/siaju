<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'SiAju Admin')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])

    @stack('styles')
</head>

<body class="bg-surface font-sans text-text antialiased">
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden lg:hidden transition-opacity duration-300 opacity-0"
        onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content Wrapper -->
    <div class="lg:pl-sidebar min-h-screen">
        <!-- Top Header -->
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-gray-100">
            <div class="flex items-center justify-between px-4 lg:px-8 py-4">
                <!-- Left Section -->
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-xl hover:bg-surface transition-smooth">
                        <svg class="w-6 h-6 text-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h2 class="font-heading font-bold text-xl lg:text-2xl gradient-text">@yield('header_title',
                            'Dashboard')</h2>
                        <p class="text-xs text-text-muted hidden sm:block">@yield('header_subtitle', 'Selamat datang
                            kembali')</p>
                    </div>
                </div>


                <!-- Right Section -->
                <div class="flex items-center gap-2 lg:gap-4">

                    <!-- Divider -->
                    <div class="hidden sm:block w-px h-8 bg-gray-200 mx-2"></div>

                    <!-- Profile -->
                    <div class="flex items-center gap-3 cursor-pointer group">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-semibold text-text group-hover:text-primary transition-colors">{{
                                auth()->user()->name ?? 'Admin Utama' }}</p>
                            <p class="text-xs text-text-muted">Superuser</p>
                        </div>
                        <img class="w-10 h-10 lg:w-11 lg:h-11 rounded-xl object-cover ring-2 ring-white shadow-md"
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=00251e&color=fff"
                            alt="Admin Profile">
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Canvas -->
        <main class="p-4 lg:p-8 pattern-bg">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle for Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }
        
        // Add staggered animation to elements
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.animate-slide-up');
            animatedElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>

    @stack('scripts')
</body>

</html>