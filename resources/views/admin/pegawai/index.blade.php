@extends('layouts.master')

@section('title', 'Data Pegawai')

@section('header_title', 'Data Pegawai')
@section('header_subtitle', 'Kelola data pegawai SKPD')

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 37, 30, 0.02);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    .gradient-header {
        background: linear-gradient(135deg, #00251e 0%, #003d33 50%, #34675c 100%);
    }
    .gradient-btn {
        background: linear-gradient(135deg, #00251e 0%, #34675c 100%);
        transition: all 0.3s ease;
    }
    .gradient-btn:hover {
        background: linear-gradient(135deg, #003d33 0%, #00251e 100%);
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0, 37, 30, 0.25);
    }
    .search-input:focus {
        box-shadow: 0 0 0 3px rgba(52, 103, 92, 0.15);
    }
    .stat-card {
        background: linear-gradient(135deg, rgba(52, 103, 92, 0.08) 0%, rgba(0, 37, 30, 0.03) 100%);
    }
</style>
@endpush

@section('content')
<div class="animate-fade-in space-y-6">
    {{-- Flash Messages --}}
    @if (session('success'))
    <div class="glass-card rounded-2xl p-4 flex items-center gap-3 shadow-lg border-l-4 border-success">
        <div class="w-10 h-10 rounded-full bg-success/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-text font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="glass-card rounded-2xl p-5 shadow-lg">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-accent flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $pegawai->total() }}</p>
                    <p class="text-sm text-text-muted">Total Pegawai</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5 shadow-lg stat-card">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent to-success flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $pegawai->pluck('skpd')->unique()->count() }}</p>
                    <p class="text-sm text-text-muted">Total SKPD</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5 shadow-lg">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-secondary to-secondary-light flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $pegawai->currentPage() }} / {{ $pegawai->lastPage() }}</p>
                    <p class="text-sm text-text-muted">Halaman</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="glass-card rounded-3xl shadow-xl overflow-hidden">
        {{-- Header + Search Bar (1 Baris) --}}
        <div class="gradient-header px-8 py-5">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 lg:gap-6">
                <div class="flex items-center justify-between lg:justify-start gap-4">
                    <div class="text-white">
                        <h2 class="text-xl font-heading font-bold">Daftar Pegawai</h2>
                        <p class="text-white/70 text-sm mt-0.5">Kelola data pegawai sistem</p>
                    </div>
                    <a href="{{ route('admin.pegawai.create') }}" 
                       class="lg:hidden inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm">Tambah</span>
                    </a>
                </div>
                <form method="GET" action="{{ route('admin.pegawai.index') }}" class="flex-1 flex gap-2">
                    <div class="relative flex-1">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="search-input w-full pl-12 pr-4 py-3 bg-white rounded-xl border-0 text-sm transition-all duration-300 placeholder-text-muted"
                               placeholder="Cari nama, NIP, atau SKPD...">
                    </div>
                    <button type="submit" 
                            class="px-5 py-3 bg-white/90 text-primary rounded-xl font-semibold flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span class="hidden sm:inline">Cari</span>
                    </button>
                    @if(request('search'))
                    <a href="{{ route('admin.pegawai.index') }}" 
                       class="px-5 py-3 bg-white/90 text-text rounded-xl font-medium flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="hidden sm:inline">Reset</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.pegawai.create') }}" 
                       class="hidden lg:inline-flex items-center gap-2 px-6 py-3 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Pegawai
                    </a>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="gradient-header">
                        <th class="px-8 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">SKPD</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($pegawai as $index => $item)
                    <tr class="table-hover transition-all duration-200">
                        <td class="px-8 py-4">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                                <span class="text-xs font-bold text-primary">{{ ($pegawai->currentPage() - 1) * $pegawai->perPage() + $index + 1 }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-primary/5 to-accent/5 text-primary rounded-lg text-sm font-semibold">
                                {{ $item->nip }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <img class="w-10 h-10 rounded-xl object-cover ring-2 ring-white shadow-md" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=00251e&color=fff" 
                                         alt="{{ $item->nama }}">
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-success rounded-full border-2 border-white"></div>
                                </div>
                                <span class="text-sm font-semibold text-text">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-text-secondary">
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $item->skpd }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-text-secondary">
                                @if($item->telp)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    {{ $item->telp }}
                                @else
                                    <span class="text-text-muted italic">-</span>
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($item->user_id)
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-success/10 text-success rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        Aktif
                                    </span>
                                    <form action="{{ route('admin.pegawai.resetPassword', $item) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                onclick="return confirm('Reset password user {{ $item->nama }} menjadi: siajuskppbjm?')"
                                                class="p-2 rounded-lg bg-warning/10 text-warning hover:bg-warning hover:text-white transition-all duration-300 shadow-sm"
                                                title="Reset Password">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-text-muted/10 text-text-muted rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        Belum
                                    </span>
                                    <form action="{{ route('admin.pegawai.createUser', $item) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                onclick="return confirm('Buat user untuk {{ $item->nama }}? Username: {{ $item->nip }}, Password: siajuskppbjm')"
                                                class="p-2 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm"
                                                title="Buat User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.pegawai.show', $item) }}" 
                                   class="p-2.5 rounded-xl bg-accent/10 text-accent hover:bg-accent hover:text-white transition-all duration-300 shadow-sm"
                                   title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.pegawai.edit', $item) }}" 
                                   class="p-2.5 rounded-xl bg-secondary-light/20 text-secondary-dark hover:bg-secondary hover:text-white transition-all duration-300 shadow-sm"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.pegawai.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                            class="p-2.5 rounded-xl bg-error/10 text-error hover:bg-error hover:text-white transition-all duration-300 shadow-sm"
                                            title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-8 py-16 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 rounded-full bg-surface-low flex items-center justify-center">
                                    <svg class="w-10 h-10 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-text font-semibold">Data tidak ditemukan</p>
                                    <p class="text-sm text-text-muted">Coba ubah kata kunci pencarian Anda</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($pegawai->hasPages())
        <div class="px-8 py-4 border-t border-gray-100 bg-surface-low">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-text-muted">
                    Menampilkan {{ $pegawai->firstItem() ?? 0 }} - {{ $pegawai->lastItem() ?? 0 }} dari {{ $pegawai->total() }} data
                </p>
                {{ $pegawai->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
