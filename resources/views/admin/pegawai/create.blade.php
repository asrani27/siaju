@extends('layouts.master')

@section('title', 'Tambah Pegawai')

@section('header_title', 'Tambah Pegawai')
@section('header_subtitle', 'Tambah data pegawai baru')

@section('content')
<div class="animate-fade-in max-w-2xl">
    {{-- Back Button --}}
    <a href="{{ route('admin.pegawai.index') }}" 
       class="inline-flex items-center gap-2 text-text-muted hover:text-primary transition-smooth mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-sm font-medium">Kembali ke daftar pegawai</span>
    </a>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-heading font-bold text-text">Form Tambah Pegawai</h2>
            <p class="text-sm text-text-muted mt-1">Lengkapi form di bawah untuk menambahkan data pegawai</p>
        </div>

        <form action="{{ route('admin.pegawai.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-5">
                {{-- NIP --}}
                <div>
                    <label for="nip" class="block text-sm font-medium text-text mb-2">
                        NIP <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="nip" 
                           name="nip" 
                           value="{{ old('nip') }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('nip') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Contoh: 198501012010011001"
                           maxlength="50">
                    @error('nip')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-text mb-2">
                        Nama Lengkap <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('nama') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Masukkan nama lengkap"
                           maxlength="255">
                    @error('nama')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- SKPD --}}
                <div>
                    <label for="skpd" class="block text-sm font-medium text-text mb-2">
                        SKPD <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="skpd" 
                           name="skpd" 
                           value="{{ old('skpd') }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('skpd') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Contoh: Dinas Komunikasi dan Informatika"
                           maxlength="255">
                    @error('skpd')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Telepon --}}
                <div>
                    <label for="telp" class="block text-sm font-medium text-text mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" 
                           id="telp" 
                           name="telp" 
                           value="{{ old('telp') }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('telp') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Contoh: 081234567890"
                           maxlength="20">
                    <p class="mt-2 text-xs text-text-muted">Opsional. Masukkan nomor telepon yang dapat dihubungi.</p>
                    @error('telp')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pegawai.index') }}" 
                   class="px-5 py-2.5 bg-surface text-text rounded-xl font-medium hover:bg-surface-high transition-smooth">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-smooth shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
