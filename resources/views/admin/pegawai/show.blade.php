@extends('layouts.master')

@section('title', 'Detail Pegawai')

@section('header_title', 'Detail Pegawai')
@section('header_subtitle', 'Informasi lengkap data pegawai')

@section('content')
<div class="animate-fade-in max-w-3xl">
    {{-- Back Button --}}
    <a href="{{ route('admin.pegawai.index') }}" 
       class="inline-flex items-center gap-2 text-text-muted hover:text-primary transition-smooth mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-sm font-medium">Kembali ke daftar pegawai</span>
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
                     src="https://ui-avatars.com/api/?name={{ urlencode($pegawai->nama) }}&size=128&background=ffffff&color=00251e" 
                     alt="{{ $pegawai->nama }}">
                <div class="text-white">
                    <h2 class="text-2xl font-heading font-bold">{{ $pegawai->nama }}</h2>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-sm font-medium backdrop-blur-sm">
                            {{ $pegawai->nip }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Section --}}
        <div class="p-6">
            <h3 class="text-lg font-heading font-bold text-text mb-4">Informasi Pegawai</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- NIP --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-primary/10 rounded-lg">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">NIP</p>
                            <p class="text-sm font-semibold text-text">{{ $pegawai->nip }}</p>
                        </div>
                    </div>
                </div>

                {{-- Nama --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-accent/10 rounded-lg">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <p class="text-sm font-semibold text-text">{{ $pegawai->nama }}</p>
                        </div>
                    </div>
                </div>

                {{-- SKPD --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-secondary-light/20 rounded-lg">
                            <svg class="w-5 h-5 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">SKPD</p>
                            <p class="text-sm font-semibold text-text">{{ $pegawai->skpd }}</p>
                        </div>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="p-4 bg-surface rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-2.5 bg-success/10 rounded-lg">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider mb-1">Telepon</p>
                            <p class="text-sm font-semibold text-text">
                                @if($pegawai->telp)
                                    {{ $pegawai->telp }}
                                @else
                                    <span class="text-text-muted italic">Tidak tersedia</span>
                                @endif
                            </p>
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
                        <span>Dibuat: {{ $pegawai->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-muted">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Diperbarui: {{ $pegawai->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <form action="{{ route('admin.pegawai.destroy', $pegawai->id) }}" method="POST" class="inline">
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
                <a href="{{ route('admin.pegawai.edit', $pegawai->id) }}" 
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
