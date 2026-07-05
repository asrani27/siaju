@extends('layouts.master')

@section('title', 'Edit Layanan')

@section('header_title', 'Edit Layanan')
@section('header_subtitle', 'Perbarui data layanan')

@section('content')
<div class="animate-fade-in max-w-2xl">
    {{-- Back Button --}}
    <a href="{{ route('admin.layanan.index') }}" 
       class="inline-flex items-center gap-2 text-text-muted hover:text-primary transition-smooth mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-sm font-medium">Kembali ke daftar layanan</span>
    </a>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-heading font-bold text-text">Form Edit Layanan</h2>
            <p class="text-sm text-text-muted mt-1">Perbarui data layanan di bawah ini</p>
        </div>

        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                {{-- Kode --}}
                <div>
                    <label for="kode" class="block text-sm font-medium text-text mb-2">
                        Kode Layanan <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="kode" 
                           name="kode" 
                           value="{{ old('kode', $layanan->kode) }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('kode') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Contoh: SKCK-001"
                           maxlength="50">
                    @error('kode')
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
                        Nama Layanan <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $layanan->nama) }}"
                           class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('nama') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm"
                           placeholder="Contoh: Surat Keterangan Catatan Kepolisian"
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

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-text mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('deskripsi') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm resize-none"
                              placeholder="Masukkan deskripsi layanan">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    <p class="mt-2 text-xs text-text-muted">Opsional. Masukkan deskripsi atau informasi tambahan tentang layanan.</p>
                    @error('deskripsi')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="flex items-start gap-3">
                    <input id="is_active" 
                           name="is_active" 
                           type="checkbox" 
                           value="1"
                           {{ old('is_active', $layanan->is_active) ? 'checked' : '' }}
                           class="mt-1">
                    <div class="text-sm">
                        <label for="is_active" class="font-medium text-text cursor-pointer">Layanan Aktif</label>
                        <p class="text-text-muted">Centang jika layanan dapat digunakan oleh pengguna</p>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.layanan.index') }}" 
                   class="px-5 py-2.5 bg-surface text-text rounded-xl font-medium hover:bg-surface-high transition-smooth">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-smooth shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
