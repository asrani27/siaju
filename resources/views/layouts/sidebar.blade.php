<aside id="sidebar"
    class="fixed left-0 top-0 h-full w-sidebar bg-gradient-to-b from-primary to-primary-light z-50 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out">
    <!-- Logo Section -->
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-secondary-light flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <h1 class="font-heading font-bold text-xl text-white">SiAju Admin</h1>
                <p class="text-xs text-white/60 tracking-wide">Sistem Informasi Administratif</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-grow py-6 overflow-y-auto">
        @auth
            @if(auth()->user()->role === 'admin')
                @include('layouts.partials.menu_admin')
            @else
                @include('layouts.partials.menu_user')
            @endif
        @endauth
    </nav>

    <!-- Bottom Section -->
    <div class="p-4 border-t border-white/10 space-y-3">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="button" onclick="confirmLogout()"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:text-error hover:bg-error/10 font-medium transition-smooth cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="text-sm">Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function confirmLogout() {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
