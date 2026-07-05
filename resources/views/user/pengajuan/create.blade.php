@extends('layouts.master')

@section('title', 'Ajukan Permohonan')
@section('header_title', 'Ajukan Permohonan')
@section('header_subtitle', 'Ajukan permohonan layanan baru')

@section('content')
<div class="mx-auto max-w-2xl space-y-6">
    {{-- Back Button --}}
    <a href="{{ route('user.dashboard') }}" 
       class="inline-flex items-center gap-2 text-text-muted hover:text-primary transition-smooth">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span class="text-sm font-medium">Kembali ke dashboard</span>
    </a>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-heading font-bold text-text">Form Pengajuan Permohonan</h2>
            <p class="text-sm text-text-muted mt-1">Pilih layanan yang diinginkan untuk memulai pengajuan</p>
        </div>

        <form action="{{ route('user.pengajuan.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-5">
                {{-- Select Layanan --}}
                <div>
                    <label for="layanan_id" class="block text-sm font-medium text-text mb-2">
                        Pilih Layanan <span class="text-error">*</span>
                    </label>
                    <select id="layanan_id" 
                            name="layanan_id"
                            class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('layanan_id') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm cursor-pointer appearance-none"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23505570%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                {{ $layanan->kode }} - {{ $layanan->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('layanan_id')
                    <p class="mt-2 text-sm text-error flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                    @if($layanans->isEmpty())
                    <p class="mt-2 text-sm text-text-muted">Tidak ada layanan yang tersedia saat ini.</p>
                    @endif
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-text mb-2">
                        Catatan (Opsional)
                    </label>
                    <textarea id="catatan" 
                              name="catatan" 
                              rows="3"
                              class="w-full px-4 py-3 bg-surface rounded-xl border {{ $errors->has('catatan') ? 'border-error focus:ring-error/20' : 'border-gray-200 focus:ring-accent/20' }} focus:ring-2 transition-smooth text-sm resize-none"
                              placeholder="Tambahkan catatan atau informasi tambahan jika diperlukan">{{ old('catatan') }}</textarea>
                    <p class="mt-2 text-xs text-text-muted">Opsional. Masukkan catatan atau keterangan tambahan.</p>
                    @error('catatan')
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
                <a href="{{ route('user.dashboard') }}" 
                   class="px-5 py-2.5 bg-surface text-text rounded-xl font-medium hover:bg-surface-high transition-smooth">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-smooth shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Ajukan Permohonan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
