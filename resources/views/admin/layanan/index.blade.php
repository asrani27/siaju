@extends('layouts.master')

@section('title', 'Data Layanan')

@section('header_title', 'Data Layanan')
@section('header_subtitle', 'Kelola data layanan SKPD')

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $layanan->total() }}</p>
                    <p class="text-sm text-text-muted">Total Layanan</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5 shadow-lg stat-card">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-success to-primary flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $layanan->where('is_active', true)->count() }}</p>
                    <p class="text-sm text-text-muted">Layanan Aktif</p>
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
                    <p class="text-2xl font-bold text-text">{{ $layanan->currentPage() }} / {{ $layanan->lastPage() }}</p>
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
                        <h2 class="text-xl font-heading font-bold">Daftar Layanan</h2>
                        <p class="text-white/70 text-sm mt-0.5">Kelola data layanan sistem</p>
                    </div>
                    <a href="{{ route('admin.layanan.create') }}" 
                       class="lg:hidden inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm">Tambah</span>
                    </a>
                </div>
                <form method="GET" action="{{ route('admin.layanan.index') }}" class="flex-1 flex flex-wrap gap-2">
                    <div class="relative flex-1 min-w-[200px]">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="search-input w-full pl-12 pr-4 py-3 bg-white rounded-xl border-0 text-sm transition-all duration-300 placeholder-text-muted"
                               placeholder="Cari kode, nama, atau deskripsi...">
                    </div>
                    <select name="status" class="px-4 py-3 bg-white/90 rounded-xl text-sm text-text border-0 focus:ring-2 focus:ring-white/50">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <button type="submit" 
                            class="px-5 py-3 bg-white/90 text-primary rounded-xl font-semibold flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span class="hidden sm:inline">Cari</span>
                    </button>
                    @if(request('search') || request('status') !== null && request('status') !== '')
                    <a href="{{ route('admin.layanan.index') }}" 
                       class="px-5 py-3 bg-white/90 text-text rounded-xl font-medium flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="hidden sm:inline">Reset</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.layanan.create') }}" 
                       class="hidden lg:inline-flex items-center gap-2 px-6 py-3 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Layanan
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Layanan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($layanan as $index => $item)
                    <tr class="table-hover transition-all duration-200">
                        <td class="px-8 py-4">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                                <span class="text-xs font-bold text-primary">{{ ($layanan->currentPage() - 1) * $layanan->perPage() + $index + 1 }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-primary/5 to-accent/5 text-primary rounded-lg text-sm font-semibold">
                                {{ $item->kode }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent/20 to-primary/20 flex items-center justify-center shadow-sm">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-text">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-text-secondary max-w-xs truncate">
                                {{ $item->deskripsi ? Str::limit($item->deskripsi, 50) : '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($item->is_active)
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-success/10 text-success rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-text-muted/10 text-text-muted rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        Nonaktif
                                    </span>
                                @endif
                                <form action="{{ route('admin.layanan.toggleStatus', $item) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }} layanan {{ $item->nama }}?')"
                                            class="p-2 rounded-lg {{ $item->is_active ? 'bg-warning/10 text-warning hover:bg-warning hover:text-white' : 'bg-success/10 text-success hover:bg-success hover:text-white' }} transition-all duration-300 shadow-sm"
                                            title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($item->is_active)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                            @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            @endif
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.layanan.show', $item) }}" 
                                   class="p-2.5 rounded-xl bg-accent/10 text-accent hover:bg-accent hover:text-white transition-all duration-300 shadow-sm"
                                   title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.persyaratan.index', $item) }}" 
                                   class="p-2.5 rounded-xl bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm"
                                   title="Persyaratan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.layanan.edit', $item) }}" 
                                   class="p-2.5 rounded-xl bg-secondary-light/20 text-secondary-dark hover:bg-secondary hover:text-white transition-all duration-300 shadow-sm"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" class="inline">
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
                        <td colspan="6" class="px-8 py-16 text-center">
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
        @if ($layanan->hasPages())
        <div class="px-8 py-4 border-t border-gray-100 bg-surface-low">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-text-muted">
                    Menampilkan {{ $layanan->firstItem() ?? 0 }} - {{ $layanan->lastItem() ?? 0 }} dari {{ $layanan->total() }} data
                </p>
                {{ $layanan->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
