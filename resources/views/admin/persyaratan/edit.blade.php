@extends('layouts.master')

@section('title', 'Edit Persyaratan - ' . $layanan->nama)

@section('header_title', 'Edit Persyaratan')
@section('header_subtitle', 'Edit persyaratan untuk layanan ' . $layanan->nama)

@push('styles')
<style>
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
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(52, 103, 92, 0.15);
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
        <a href="{{ route('admin.persyaratan.index', $layanan) }}" class="text-text-muted hover:text-primary transition-colors">
            Persyaratan
        </a>
        <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-text font-medium">Edit</span>
    </div>

    {{-- Flash Messages --}}
    @if ($errors->any())
    <div class="glass-card rounded-2xl p-4 flex items-start gap-3 shadow-lg border-l-4 border-error">
        <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-error font-semibold">Terjadi kesalahan!</p>
            <ul class="text-sm text-text-muted mt-1 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Form Card --}}
    <div class="glass-card rounded-3xl shadow-xl overflow-hidden">
        <div class="gradient-header px-8 py-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-heading font-bold">Form Edit Persyaratan</h2>
                    <p class="text-white/70 text-sm mt-0.5">{{ $layanan->nama }} ({{ $layanan->kode }})</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.persyaratan.update', [$layanan, $persyaratan]) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Nama --}}
                <div class="lg:col-span-2">
                    <label for="nama" class="block text-sm font-semibold text-text mb-2">
                        Nama Persyaratan <span class="text-error">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $persyaratan->nama) }}"
                           class="form-input w-full px-4 py-3 bg-surface rounded-xl border border-gray-200 text-text text-sm transition-all duration-300 placeholder-text-muted focus:outline-none focus:border-primary"
                           placeholder="Masukkan nama persyaratan"
                           required>
                    <p class="text-xs text-text-muted mt-1">Contoh: Fotokopi KTP, Pas Foto 3x4, dll</p>
                </div>

                {{-- Keterangan --}}
                <div class="lg:col-span-2">
                    <label for="keterangan" class="block text-sm font-semibold text-text mb-2">
                        Keterangan
                    </label>
                    <textarea id="keterangan" 
                              name="keterangan" 
                              rows="4"
                              class="form-input w-full px-4 py-3 bg-surface rounded-xl border border-gray-200 text-text text-sm transition-all duration-300 placeholder-text-muted focus:outline-none focus:border-primary resize-none"
                              placeholder="Masukkan keterangan detail persyaratan">{{ old('keterangan', $persyaratan->keterangan) }}</textarea>
                    <p class="text-xs text-text-muted mt-1">Jelaskan detail persyaratan jika diperlukan</p>
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="urutan" class="block text-sm font-semibold text-text mb-2">
                        Urutan Tampil
                    </label>
                    <input type="number" 
                           id="urutan" 
                           name="urutan" 
                           value="{{ old('urutan', $persyaratan->urutan) }}"
                           min="1"
                           class="form-input w-full px-4 py-3 bg-surface rounded-xl border border-gray-200 text-text text-sm transition-all duration-300 placeholder-text-muted focus:outline-none focus:border-primary">
                    <p class="text-xs text-text-muted mt-1">Urutan penampilan persyaratan</p>
                </div>

                {{-- Is Required --}}
                <div>
                    <label class="block text-sm font-semibold text-text mb-2">
                        Status Kewajiban
                    </label>
                    <div class="mt-1">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_required" 
                                   value="1" 
                                   {{ old('is_required', $persyaratan->is_required) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ms-3 text-sm font-medium text-text peer-checked:text-primary">Persyaratan Wajib</span>
                        </label>
                    </div>
                    <p class="text-xs text-text-muted mt-1">Centang jika persyaratan ini wajib dipenuhi</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.persyaratan.index', $layanan) }}" 
                   class="px-6 py-3 bg-surface text-text rounded-xl font-semibold hover:bg-surface-low transition-all duration-300 shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                        class="gradient-btn px-8 py-3 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
