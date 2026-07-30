<!-- Menu Utama -->
<div class="px-4 mb-2">
    <span class="text-xs font-semibold text-white/40 uppercase tracking-wider">Menu Utama</span>
</div>
<div class="space-y-1 px-3">
    <!-- Dashboard -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('skpd.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('skpd.dashboard') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-sm">Dashboard</span>
        @if(request()->routeIs('skpd.dashboard'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Data Pegawai -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('skpd.pegawai.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('skpd.pegawai.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span class="text-sm">Data Pegawai</span>
        @if(request()->routeIs('skpd.pegawai.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Profil -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('skpd.profil.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('skpd.profil.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-sm">Profil</span>
        @if(request()->routeIs('skpd.profil.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
</div>
