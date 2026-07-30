<!-- Menu Utama -->
<div class="px-4 mb-2">
    <span class="text-xs font-semibold text-white/40 uppercase tracking-wider">Menu Utama</span>
</div>
<div class="space-y-1 px-3">
    <!-- Dashboard -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.dashboard') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-sm">Dashboard</span>
        @if(request()->routeIs('admin.dashboard'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Data Pegawai -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.pegawai.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.pegawai.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span class="text-sm">Data Pegawai</span>
        @if(request()->routeIs('admin.pegawai.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Data SKPD -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.skpd.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.skpd.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
        <span class="text-sm">Data SKPD</span>
        @if(request()->routeIs('admin.skpd.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Data Layanan -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.layanan.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.layanan.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        <span class="text-sm">Data Layanan</span>
        @if(request()->routeIs('admin.layanan.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Pengajuan Masuk -->
    {{-- <a
        class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.pengajuan.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.pengajuan.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
        </svg>
        <span class="text-sm">Pengajuan Masuk</span>
        @if(request()->routeIs('admin.pengajuan.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a> --}}
</div>

<!-- Pengaturan -->
<div class="px-4 mt-6 mb-2">
    <span class="text-xs font-semibold text-white/40 uppercase tracking-wider">Pengaturan</span>
</div>
<div class="space-y-1 px-3">
    <!-- Pengaturan -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.pengaturan.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.pengaturan.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="text-sm">Pengaturan</span>
        @if(request()->routeIs('admin.pengaturan.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
    <!-- Bantuan -->
    <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-smooth group {{ request()->routeIs('admin.bantuan.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
        href="{{ route('admin.bantuan.index') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm">Bantuan</span>
        @if(request()->routeIs('admin.bantuan.*'))
        <span class="ml-auto w-2 h-2 rounded-full bg-secondary-light"></span>
        @endif
    </a>
</div>