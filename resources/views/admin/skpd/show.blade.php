@extends('layouts.master')

@section('title', 'Detail SKPD')

@section('header_title', 'Detail SKPD')
@section('header_subtitle', 'Informasi lengkap data SKPD')

@section('content')
<div class="animate-fade-in max-w-3xl">
    {{-- Back Button --}}
    <a href="{{ route('admin.skpd.index') }}" 
       class="inline-flex items-center gap-2 text-text-muted hover:text-primary transition-smooth mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-sm font-medium">Kembali ke daftar SKPD</span>
    </a>

    {{-- Profile Card --}}
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        {{-- Header Section --}}
        <div class="relative px-6 py-8 bg-gradient-to-br from-primary to-accent">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,100 C30,80 70,90 100,70 L100,0 L0,0 Z" fill="white"/>
                </svg>
            </div>
            <div class="relative flex items-center gap-5">
                <img class="w-24 h-24 rounded-2xl object-cover ring-4 ring-white/30 shadow-lg" 
                     src="https://ui-avatars.com/api/?name={{ urlencode($skpd->nama_skpd) }}&size=128&background=ffffff&color=00251e" 
                     alt="{{ $skpd->nama_skpd }}">
                <div class="text-white">
                    <h2 class="text-2xl font-heading font-bold">{{ $skpd->nama_skpd }}</h2>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-sm font-medium">
                            {{ $skpd->kode_skpd }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Section --}}
        <div class="p-6">
            <h3 class="text-lg font-heading font-bold text-text mb-4">Informasi SKPD</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Kode SKPD --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-primary/10 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Kode SKPD</p>
                            <p class="text-sm font-semibold text-text">{{ $skpd->kode_skpd }}</p>
                        </div>
                    </div>
                </div>

                {{-- Nama SKPD --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-accent/10 rounded-lg">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Nama SKPD</p>
                            <p class="text-sm font-semibold text-text">{{ $skpd->nama_skpd }}</p>
                        </div>
                    </div>
                </div>

                {{-- Status User --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-success/10 rounded-lg">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Status User</p>
                            @if($skpd->user_id)
                                <p class="text-sm font-semibold text-success">Aktif</p>
                            @else
                                <p class="text-sm font-semibold text-text-muted italic">Belum ada user</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Username --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-secondary-light/20 rounded-lg">
                            <svg class="w-5 h-5 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Username</p>
                            @if($skpd->user_id)
                                <p class="text-sm font-semibold text-text">{{ $skpd->kode_skpd }}</p>
                            @else
                                <p class="text-sm font-semibold text-text-muted italic">-</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Timestamps --}}
            <div class="mt-6 pt-6 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-2 text-sm text-text-muted">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Dibuat: {{ $skpd->created_at ? $skpd->created_at->format('d M Y, H:i') : '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-muted">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Diperbarui: {{ $skpd->updated_at ? $skpd->updated_at->format('d M Y, H:i') : '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <form action="{{ route('admin.skpd.destroy', $skpd->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                            class="px-5 py-2.5 bg-error/10 text-error rounded-xl font-medium hover:bg-error/20 transition-smooth flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.skpd.edit', $skpd->id) }}" 
                   class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-smooth shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
