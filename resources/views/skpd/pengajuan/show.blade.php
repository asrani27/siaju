@extends('layouts.master')

@section('title', 'Detail Pengajuan - ' . $pengajuan->nomor_pengajuan)
@section('header_title', 'Detail Pengajuan')
@section('header_subtitle', $pengajuan->nomor_pengajuan)

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm">
        <a href="{{ route('skpd.dashboard') }}"
            class="text-text-muted hover:text-primary transition-colors">Dashboard</a>
        <span class="text-text-muted">/</span>
        <a href="{{ route('skpd.pengajuan.index') }}"
            class="text-text-muted hover:text-primary transition-colors">Pengajuan</a>
        <span class="text-text-muted">/</span>
        <span class="text-text">{{ $pengajuan->nomor_pengajuan }}</span>
    </nav>

    @if(session('success'))
    <div class="bg-success/10 border border-success/20 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-success flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <p class="text-sm text-success">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Header Actions -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('skpd.pengajuan.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar
        </a>

        @php
        $statusConfig = [
        'draft' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'label' => 'Draft'],
        'dikirim' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Dikirim'],
        'verifikasi' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'Verifikasi'],
        'diproses' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600', 'label' => 'Diproses'],
        'revisi' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'label' => 'Revisi'],
        'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'Selesai'],
        'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Ditolak'],
        'dibatalkan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-500', 'label' => 'Dibatalkan'],
        ];
        $status = $statusConfig[$pengajuan->status] ?? $statusConfig['draft'];
        @endphp

        <span
            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $status['bg'] }} {{ $status['text'] }}">
            {{ $status['label'] }}
        </span>
    </div>

    <!-- SK File Available Alert -->
    @if($pengajuan->status === 'selesai' && $pengajuan->sk_file)
    <div class="bg-success/10 border border-success/20 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-success flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
        </svg>
        <div class="flex-1">
            <p class="text-sm font-medium text-success">SK File tersedia</p>
            <p class="text-xs text-text-muted mt-1">Pengajuan telah selesai diproses.</p>
            <div class="flex items-center gap-2 mt-3">
                @include('skpd.partials.action-view-sk', ['pengajuan' => $pengajuan])
                @include('skpd.partials.action-download-sk', ['pengajuan' => $pengajuan])
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Info -->
        <div class="lg:col-span-2 space-y-6">
            @php
            $canEdit = in_array($pengajuan->status, ['draft', 'revisi']);
            @endphp

            @if($canEdit)
            <!-- Kirim Button Card -->
            <div
                class="bg-gradient-to-r from-primary/10 to-accent/5 rounded-2xl shadow-card p-6 border border-primary/20">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-base font-semibold text-text">Kirim Pengajuan</p>
                            <p class="text-sm text-text-muted">Pastikan semua dokumen persyaratan sudah lengkap</p>
                        </div>
                    </div>
                    <form action="{{ route('skpd.pengajuan.kirim', $pengajuan) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin mengirim pengajuan ini? Pastikan semua dokumen sudah lengkap.')">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary/90 text-white text-sm font-semibold rounded-xl transition-smooth shadow-lg shadow-primary/20">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            Kirim Sekarang
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Info Pemohon -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Informasi Pemohon
                </h3>
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-lg flex-shrink-0">
                        {{ substr($pengajuan->user->name ?? 'N', 0, 2) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-text">{{ $pengajuan->user->name ?? 'N/A' }}</p>
                        <p class="text-sm text-text-muted">NIP: {{ $pengajuan->user->username ?? 'N/A' }}</p>
                        <p class="text-sm text-text-muted">Email: {{ $pengajuan->user->email ?? 'N/A' }}</p>
                        <p class="text-sm text-text-muted">Telepon: {{ $pengajuan->user->no_telp ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Pengajuan -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Informasi Pengajuan
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-text-muted">Nomor Pengajuan</p>
                        <p class="text-base font-semibold text-primary">{{ $pengajuan->nomor_pengajuan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-muted">Layanan</p>
                        <p class="text-base font-semibold text-text">{{ $pengajuan->layanan->nama ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-muted">Tanggal Pengajuan</p>
                        <p class="text-base font-semibold text-text">{{ $pengajuan->tanggal_pengajuan->format('d M Y')
                            }}</p>
                    </div>
                    @if($pengajuan->tanggal_selesai)
                    <div>
                        <p class="text-sm text-text-muted">Tanggal Selesai</p>
                        <p class="text-base font-semibold text-success">{{ $pengajuan->tanggal_selesai->format('d M Y')
                            }}</p>
                    </div>
                    @endif
                </div>
                @if($pengajuan->catatan_user)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-sm text-text-muted">Catatan Pemohon</p>
                    <p class="text-base text-text">{{ $pengajuan->catatan_user }}</p>
                </div>
                @endif
            </div>

            <!-- Persyaratan & File -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                @php
                $totalFiles = $pengajuan->files->count();
                $totalRequired = $persyaratans->count();
                @endphp
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading font-bold text-lg text-text flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Dokumen Persyaratan
                    </h3>
                    @if($canEdit)
                    <button type="button" onclick="document.getElementById('upload-form').classList.toggle('hidden')"
                        class="px-4 py-2 bg-primary hover:bg-primary/90 text-white text-sm font-medium rounded-xl transition-smooth flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V165m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        {{ $totalFiles < $totalRequired ? 'Upload Dokumen' : 'Ganti File' }} </button>
                            @endif
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <span class="text-sm text-text-muted">Progress:</span>
                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-xs">
                        <div class="bg-success h-2 rounded-full"
                            style="width: {{ $totalRequired > 0 ? ($totalFiles / $totalRequired) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-text">{{ $totalFiles }}/{{ $totalRequired }} file</span>
                </div>

                <!-- Upload Form -->
                <div id="upload-form" class="hidden mb-4 p-4 bg-surface rounded-xl border border-primary/20">
                    <form action="{{ route('skpd.pengajuan.upload.store', $pengajuan) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        <p class="text-sm text-text-muted mb-3">Pilih file untuk diupload atau ganti file yang sudah
                            ada:</p>
                        @foreach($persyaratans as $persyaratan)
                        @php
                        $file = $pengajuan->files->where('persyaratan_id', $persyaratan->id)->first();
                        @endphp
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-text">{{ $persyaratan->nama }}</p>
                                @if($file)
                                <p class="text-xs text-success">✓ {{ $file->nama_file }} ({{ number_format($file->ukuran
                                    / 1024, 2) }} KB)</p>
                                @endif
                            </div>
                            <div class="border-2 border-dashed {{ $file ? 'border-warning/50 hover:border-warning' : 'border-gray-300 hover:border-primary/50' }} rounded-lg p-2 transition-colors cursor-pointer flex-shrink-0 w-48"
                                onclick="document.getElementById('file_{{ $persyaratan->id }}').click()">
                                <input type="file" name="files[{{ $persyaratan->id }}]" id="file_{{ $persyaratan->id }}"
                                    class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                                    onchange="showFileName(this, '{{ $persyaratan->id }}')">
                                <div id="preview_{{ $persyaratan->id }}" class="text-center">
                                    @if($file)
                                    <svg class="w-5 h-5 text-warning mx-auto mb-1" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <p class="text-xs text-warning font-medium">Klik untuk ganti</p>
                                    @else
                                    <svg class="w-6 h-6 text-text-muted mx-auto mb-1" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V165m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>
                                    <p class="text-xs text-text-muted">Klik untuk upload</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-end gap-2 pt-2">
                            <button type="button"
                                onclick="document.getElementById('upload-form').classList.add('hidden')"
                                class="px-4 py-2 text-sm font-medium text-text-muted hover:text-text transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-success hover:bg-success/90 text-white text-sm font-medium rounded-xl transition-smooth">
                                Simpan Upload
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-3">
                    @forelse($persyaratans as $persyaratan)
                    @php
                    $file = $pengajuan->files->where('persyaratan_id', $persyaratan->id)->first();
                    @endphp
                    <div class="flex items-center justify-between p-4 bg-surface rounded-xl">
                        <div class="flex items-center gap-3">
                            @if($file)
                            <div class="w-10 h-10 rounded-lg bg-success/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-success" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            @else
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-text">{{ $persyaratan->nama }}</p>
                                @if($file)
                                <p class="text-xs text-text-muted">{{ $file->nama_file }} ({{
                                    number_format($file->ukuran / 1024, 2) }} KB)</p>
                                @else
                                <p class="text-xs text-text-muted">Belum diupload</p>
                                @endif
                            </div>
                        </div>
                        @if($file)
                        <div class="flex items-center gap-2">
                            <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                class="p-2 rounded-lg bg-white hover:bg-primary/10 transition-smooth text-text-muted hover:text-primary"
                                title="Lihat File">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            <a href="{{ asset('storage/' . $file->file) }}" download="{{ $file->nama_file }}"
                                class="p-2 rounded-lg bg-white hover:bg-success/10 transition-smooth text-text-muted hover:text-success"
                                title="Download File">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-sm text-text-muted text-center py-4">Tidak ada persyaratan untuk layanan ini</p>
                    @endforelse
                </div>
            </div>

            <!-- Riwayat Status (Shopee-style) -->
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-primary/5 to-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-heading font-bold text-lg text-text">📦 Riwayat Pengajuan</h5>
                            <p class="text-xs text-text-muted mt-0.5">{{ $histories->count() }} aktivitas</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    @if($histories->count() > 0)
                    <!-- Shopee-style timeline -->
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div
                            class="absolute left-[22px] top-4 bottom-4 w-1 bg-gradient-to-b from-primary via-accent to-gray-200 rounded-full">
                        </div>

                        <!-- Timeline Items -->
                        <div class="space-y-4">
                            @foreach($histories as $index => $history)
                            <div class="relative flex items-start gap-4 group">
                                <!-- Status icon -->
                                <div class="relative z-10 flex-shrink-0">
                                    <div class="w-11 h-11 rounded-full flex items-center justify-center 
                                        @if($index === 0) 
                                        bg-gradient-to-br from-primary to-primary/80 text-white shadow-lg shadow-primary/30 ring-4 ring-primary/10
                                        @elseif(str_contains($history->status, 'selesai') || str_contains($history->status, 'ditolak'))
                                        bg-gradient-to-br from-gray-400 to-gray-500 text-white
                                        @else
                                        bg-white border-2 border-gray-200 text-text-muted
                                        @endif">
                                        @if($index === 0)
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                        @elseif(str_contains($history->status, 'selesai'))
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                        @elseif(str_contains($history->status, 'ditolak'))
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                        @else
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                <!-- Timeline Content -->
                                <div class="flex-1 min-w-0 @if($index < count($histories) - 1) pb-5 @endif">
                                    <div
                                        class="bg-gradient-to-br from-surface to-surface/50 rounded-xl p-4 border border-gray-100 group-hover:border-primary/20 group-hover:shadow-md transition-all duration-300">
                                        <p class="text-sm font-semibold text-text leading-tight">{{ $history->judul }}
                                        </p>

                                        @if($history->keterangan)
                                        <p class="text-xs text-text-muted mt-1.5 leading-relaxed">{{
                                            $history->keterangan }}</p>
                                        @endif

                                        <!-- Status Badge -->
                                        <div class="flex items-center gap-2 mt-3">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold 
                                                @if(str_contains($history->status, 'draft'))
                                                bg-gray-100 text-gray-600
                                                @elseif(str_contains($history->status, 'dikirim'))
                                                bg-blue-50 text-blue-600
                                                @elseif(str_contains($history->status, 'verifikasi'))
                                                bg-yellow-50 text-yellow-600
                                                @elseif(str_contains($history->status, 'revisi'))
                                                bg-orange-50 text-orange-600
                                                @elseif(str_contains($history->status, 'diproses'))
                                                bg-indigo-50 text-indigo-600
                                                @elseif(str_contains($history->status, 'selesai'))
                                                bg-green-50 text-green-600
                                                @elseif(str_contains($history->status, 'ditolak'))
                                                bg-red-50 text-red-600
                                                @else
                                                bg-gray-100 text-gray-600
                                                @endif">
                                                @if($index === 0)
                                                <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                                @endif
                                                {{ ucfirst($history->status) }}
                                            </span>
                                        </div>

                                        <!-- Timestamp & User -->
                                        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100/50">
                                            <svg class="w-3.5 h-3.5 text-text-muted" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                            <span class="text-xs text-text-muted">
                                                {{ $history->created_at->format('d M Y, H:i') }}
                                            </span>
                                            @if($history->user)
                                            <span class="text-text-muted text-xs">•</span>
                                            <svg class="w-3.5 h-3.5 text-text-muted" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                            <span class="text-xs text-text-muted font-medium">{{ $history->user->name
                                                }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <p class="text-sm text-text-muted font-medium">Belum ada riwayat aktivitas</p>
                        <p class="text-xs text-text-muted/70 mt-1">Aktivitas pengajuan akan muncul di sini</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-6">
            <!-- Summary Card -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4">Ringkasan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-muted">Total Persyaratan</span>
                        <span class="text-sm font-semibold text-text">{{ $totalRequired }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-muted">File Diupload</span>
                        <span class="text-sm font-semibold text-success">{{ $totalFiles }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-muted">File Belum Ada</span>
                        <span class="text-sm font-semibold text-text-muted">{{ $totalRequired - $totalFiles }}</span>
                    </div>
                    <div class="pt-3 border-t border-gray-100">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-text-muted">Kelengkapan</span>
                            <span
                                class="text-sm font-semibold {{ ($totalFiles / max($totalRequired, 1)) * 100 >= 100 ? 'text-success' : 'text-warning' }}">
                                {{ $totalRequired > 0 ? round(($totalFiles / $totalRequired) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revision History -->
            @if($revisions->count() > 0)
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Catatan Revisi
                </h3>
                <div class="space-y-3">
                    @foreach($revisions as $revision)
                    <div class="p-3 bg-warning/5 border border-warning/20 rounded-lg">
                        <p class="text-sm text-text">{{ $revision->catatan }}</p>
                        <p class="text-xs text-text-muted mt-1">
                            @if($revision->tanggal_revisi)
                            {{ $revision->tanggal_revisi->format('d M Y, H:i') }}
                            @else
                            -
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Info -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4">Info Tambahan</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-text-muted">Dibuat:</span>
                        <p class="text-text font-medium">{{ $pengajuan->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <span class="text-text-muted">Terakhir Diupdate:</span>
                        <p class="text-text font-medium">{{ $pengajuan->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showFileName(input, persyaratanId) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var preview = document.getElementById('preview_' + persyaratanId);
        var fileSize = (file.size / (1024 * 1024)).toFixed(2);
        
        var icon = file.type === 'application/pdf' 
            ? '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />'
            : '<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />';
        
        var iconBg = file.type === 'application/pdf' ? 'bg-red-100' : 'bg-blue-100';
        var iconColor = file.type === 'application/pdf' ? 'text-red-600' : 'text-blue-600';
        
        preview.innerHTML = '<div class="text-xs text-primary font-medium truncate">' + file.name + '</div><div class="text-xs text-text-muted">' + fileSize + ' MB</div>';
    }
}
</script>
@endpush