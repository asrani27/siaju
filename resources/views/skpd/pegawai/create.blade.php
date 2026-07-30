@extends('layouts.master')

@section('title', 'Tambah Pegawai - SKPD')
@section('header_title', 'Tambah Pegawai')
@section('header_subtitle', 'Tambah data pegawai baru')

@section('content')
<div class="mx-auto space-y-6 lg:space-y-8">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('skpd.pegawai.index') }}" class="p-2 rounded-xl bg-white shadow-card hover:bg-surface transition-colors">
            <svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h3 class="font-heading font-bold text-2xl text-text">Tambah Pegawai</h3>
            <p class="text-text-muted text-sm mt-1">Tambah data pegawai {{ $skpd->nama_skpd ?? "SKPD" }}</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-card p-6 lg:p-8">
        <form action="{{ route('skpd.pegawai.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nip" class="block text-sm font-semibold text-text mb-2">NIP <span class="text-error">*</span></label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required
                        class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('nip') ring-2 ring-error @enderror"
                        placeholder="Masukkan NIP">
                    @error('nip')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama" class="block text-sm font-semibold text-text mb-2">Nama Lengkap <span class="text-error">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                        class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('nama') ring-2 ring-error @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('nama')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="telp" class="block text-sm font-semibold text-text mb-2">Nomor Telepon</label>
                <input type="text" id="telp" name="telp" value="{{ old('telp') }}"
                    class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('telp') ring-2 ring-error @enderror"
                    placeholder="Masukkan nomor telepon">
                @error('telp')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('skpd.pegawai.index') }}" class="px-6 py-3 bg-gray-100 text-text font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-primary/20">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
