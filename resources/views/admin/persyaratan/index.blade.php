@extends('layouts.master')

@section('title', 'Data Persyaratan - ' . $layanan->nama)

@section('header_title', 'Data Persyaratan')
@section('header_subtitle', 'Kelola persyaratan layanan ' . $layanan->nama)

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
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('admin.layanan.index') }}" class="text-text-muted hover:text-primary transition-colors">
            Layanan
        </a>
        <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-text font-medium">Persyaratan</span>
    </div>

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $persyaratans->total() }}</p>
                    <p class="text-sm text-text-muted">Total Persyaratan</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5 shadow-lg stat-card">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-error to-secondary flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $persyaratans->where('is_required', true)->count() }}</p>
                    <p class="text-sm text-text-muted">Wajib</p>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5 shadow-lg">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-success to-primary flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-text">{{ $persyaratans->where('is_required', false)->count() }}</p>
                    <p class="text-sm text-text-muted">Opsional</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="glass-card rounded-3xl shadow-xl overflow-hidden">
        {{-- Header + Search Bar --}}
        <div class="gradient-header px-8 py-5">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 lg:gap-6">
                <div class="flex items-center justify-between lg:justify-start gap-4">
                    <div class="text-white">
                        <h2 class="text-xl font-heading font-bold">Persyaratan Layanan</h2>
                        <p class="text-white/70 text-sm mt-0.5">{{ $layanan->nama }} ({{ $layanan->kode }})</p>
                    </div>
                    <a href="{{ route('admin.persyaratan.create', $layanan) }}" 
                       class="lg:hidden inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm">Tambah</span>
                    </a>
                </div>
                <form method="GET" action="{{ route('admin.persyaratan.index', $layanan) }}" class="flex-1 flex flex-wrap gap-2">
                    <div class="relative flex-1 min-w-[200px]">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="search-input w-full pl-12 pr-4 py-3 bg-white rounded-xl border-0 text-sm transition-all duration-300 placeholder-text-muted"
                               placeholder="Cari nama atau keterangan...">
                    </div>
                    <select name="status" class="px-4 py-3 bg-white/90 rounded-xl text-sm text-text border-0 focus:ring-2 focus:ring-white/50">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Wajib</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Opsional</option>
                    </select>
                    <button type="submit" 
                            class="px-5 py-3 bg-white/90 text-primary rounded-xl font-semibold flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span class="hidden sm:inline">Cari</span>
                    </button>
                    @if(request('search') || request('status') !== null && request('status') !== '')
                    <a href="{{ route('admin.persyaratan.index', $layanan) }}" 
                       class="px-5 py-3 bg-white/90 text-text rounded-xl font-medium flex items-center justify-center gap-2 hover:bg-white transition-all duration-300 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="hidden sm:inline">Reset</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.persyaratan.create', $layanan) }}" 
                       class="hidden lg:inline-flex items-center gap-2 px-6 py-3 bg-white text-primary rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Persyaratan
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Urutan</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($persyaratans as $index => $item)
                    <tr class="table-hover transition-all duration-200">
                        <td class="px-8 py-4">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                                <span class="text-xs font-bold text-primary">{{ ($persyaratans->currentPage() - 1) * $persyaratans->perPage() + $index + 1 }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent/20 to-primary/20 flex items-center justify-center shadow-sm">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-text">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-text-secondary max-w-xs truncate">
                                {{ $item->keterangan ? Str::limit($item->keterangan, 50) : '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-primary/5 to-accent/5 text-primary rounded-lg text-sm font-semibold">
                                    {{ $item->urutan }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($item->is_required)
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-error/10 text-error rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        Wajib
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-text-muted/10 text-text-muted rounded-lg text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                        Opsional
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.persyaratan.edit', [$layanan, $item]) }}" 
                                   class="p-2.5 rounded-xl bg-secondary-light/20 text-secondary-dark hover:bg-secondary hover:text-white transition-all duration-300 shadow-sm"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.persyaratan.destroy', [$layanan, $item]) }}" method="POST" class="inline">
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
        @if ($persyaratans->hasPages())
        <div class="px-8 py-4 border-t border-gray-100 bg-surface-low">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-text-muted">
                    Menampilkan {{ $persyaratans->firstItem() ?? 0 }} - {{ $persyaratans->lastItem() ?? 0 }} dari {{ $persyaratans->total() }} data
                </p>
                {{ $persyaratans->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
