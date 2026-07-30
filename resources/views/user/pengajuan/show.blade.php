@extends('layouts.master')

@section('title', 'Detail Pengajuan - ' . $pengajuan->nomor_pengajuan)
@section('header_title', 'Detail Pengajuan')
@section('header_subtitle', $pengajuan->nomor_pengajuan)

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm">
        <a href="{{ route('user.dashboard') }}"
            class="text-text-muted hover:text-primary transition-colors">Dashboard</a>
        <span class="text-text-muted">/</span>
        <a href="{{ route('user.pengajuan.index') }}"
            class="text-text-muted hover:text-primary transition-colors">Pengajuan</a>
        <span class="text-text-muted">/</span>
        <span class="text-text">{{ $pengajuan->nomor_pengajuan }}</span>
    </nav>

    <!-- Status Alert -->
    @if($pengajuan->status === 'revisi')
    <div class="bg-error/10 border border-error/20 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-error flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div>
            <p class="text-sm font-medium text-error">Pengajuan memerlukan revisi</p>
            <p class="text-xs text-text-muted mt-1">Silakan upload ulang dokumen persyaratan sesuai catatan dari admin.
            </p>
            @if($pengajuan->catatan_user)
            <div class="mt-2 p-2 bg-white rounded-lg border border-error/20">
                <p class="text-xs text-text-muted"><span class="font-medium">Catatan:</span> {{ $pengajuan->catatan_user
                    }}</p>
            </div>
            @endif
            <a href="{{ route('user.pengajuan.upload', $pengajuan) }}"
                class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-error text-white text-xs font-semibold rounded-lg hover:bg-error/90 transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                Upload Ulang Persyaratan
            </a>
        </div>
    </div>
    @endif

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

    <!-- SK File Available Alert -->
    @if($pengajuan->status === 'selesai' && $pengajuan->sk_file)
    <div class="bg-success/10 border border-success/20 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-success flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
        </svg>
        <div class="flex-1">
            <p class="text-sm font-medium text-success">SK File tersedia</p>
            <p class="text-xs text-text-muted mt-1">Pengajuan Anda telah selesai diproses. SK file dapat diunduh di bawah.</p>
            <div class="flex items-center gap-2 mt-3">
                <a href="{{ asset('storage/' . $pengajuan->sk_file) }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-success text-white text-xs font-semibold rounded-lg hover:bg-success/90 transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Lihat SK
                </a>
                <a href="{{ asset('storage/' . $pengajuan->sk_file) }}" download="{{ basename($pengajuan->sk_file) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-success/10 hover:bg-success/20 border border-success/30 text-success text-xs font-semibold rounded-lg transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Download SK
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pengajuan -->
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-heading font-bold text-lg text-text">Informasi Pengajuan</h5>
                            <p class="text-sm text-text-muted mt-1">Detail pengajuan layanan Anda</p>
                        </div>
                        <div class="flex items-center gap-3">
                            @if(in_array($pengajuan->status, ['draft', 'revisi']))
                            @php
                            $persyaratansCount = $persyaratans->count();
                            $uploadedCount = $pengajuan->files->count();
                            $allFilesUploaded = $uploadedCount >= $persyaratansCount;
                            @endphp
                            <form action="{{ route('user.pengajuan.kirim', $pengajuan) }}" method="POST" id="kirimForm">
                                @csrf
                                <button type="submit" 
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white text-xs font-semibold rounded-lg hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if(!$allFilesUploaded) disabled title="Upload semua dokumen terlebih dahulu" @else onclick="return confirm('Yakin sudah lengkap dan benar?')" @endif>
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    Kirim Pengajuan
                                </button>
                            </form>
                            @endif
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $pengajuan->getStatusBadgeClass() }}">
                                @if(in_array($pengajuan->status, ['dikirim', 'verifikasi', 'diproses']))
                                <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5 animate-pulse"></span>
                                @endif
                                {{ $pengajuan->getStatusLabel() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Layanan -->
                    <div class="flex items-start gap-4 p-4 bg-surface rounded-xl">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-text-muted uppercase tracking-wide">Jenis Layanan</p>
                            <p class="text-sm font-semibold text-text mt-0.5">{{ $pengajuan->layanan->nama ?? 'Layanan'
                                }}</p>
                        </div>
                    </div>

                    <!-- Grid Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Tanggal Pengajuan -->
                        <div class="p-4 bg-surface rounded-xl">
                            <p class="text-xs text-text-muted uppercase tracking-wide">Tanggal Pengajuan</p>
                            <p class="text-sm font-semibold text-text mt-0.5">{{
                                $pengajuan->tanggal_pengajuan->format('d M Y') }}</p>
                        </div>

                        <!-- Nomor Pengajuan -->
                        <div class="p-4 bg-surface rounded-xl">
                            <p class="text-xs text-text-muted uppercase tracking-wide">Nomor Pengajuan</p>
                            <p class="text-sm font-semibold text-text mt-0.5 font-mono">{{ $pengajuan->nomor_pengajuan
                                }}</p>
                        </div>

                        <!-- Tanggal Selesai -->
                        @if($pengajuan->tanggal_selesai)
                        <div class="p-4 bg-surface rounded-xl">
                            <p class="text-xs text-text-muted uppercase tracking-wide">Tanggal Selesai</p>
                            <p class="text-sm font-semibold text-text mt-0.5">{{ $pengajuan->tanggal_selesai->format('d
                                M Y') }}</p>
                        </div>
                        @endif

                        <!-- Total Dokumen -->
                        <div class="p-4 bg-surface rounded-xl">
                            <p class="text-xs text-text-muted uppercase tracking-wide">Dokumen Diupload</p>
                            <p class="text-sm font-semibold text-text mt-0.5">{{ $pengajuan->files->count() }} / {{
                                $persyaratans->count() }} file</p>
                        </div>
                    </div>

                    <!-- Catatan User -->
                    @if($pengajuan->catatan_user)
                    <div class="p-4 bg-surface rounded-xl">
                        <p class="text-xs text-text-muted uppercase tracking-wide">Catatan</p>
                        <p class="text-sm text-text mt-0.5">{{ $pengajuan->catatan_user }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Persyaratan & File Uploaded -->
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-heading font-bold text-lg text-text">Dokumen Persyaratan</h5>
                            <p class="text-sm text-text-muted mt-1">File yang telah diupload untuk pengajuan ini</p>
                        </div>
                        @if($pengajuan->status === 'draft' || $pengajuan->status === 'revisi')
                        <a href="{{ route('user.pengajuan.upload', $pengajuan) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white text-xs font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                            {{ $pengajuan->files->isEmpty() ? 'Upload' : 'Edit' }} Dokumen
                        </a>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if($persyaratans->count() > 0)
                    <div class="space-y-3">
                        @foreach($persyaratans as $persyaratan)
                        @php
                        $uploadedFile = $uploadedFiles->get($persyaratan->id)?->first();
                        @endphp
                        <div
                            class="flex items-center justify-between p-4 bg-surface rounded-xl border border-gray-100 hover:border-primary/30 transition-colors">
                            <div class="flex items-center gap-3">
                                @if($uploadedFile)
                                @if($uploadedFile->isPdf())
                                <div
                                    class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 flex-shrink-0">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                @else
                                <div
                                    class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                                @endif
                                @else
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 flex-shrink-0">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-text">{{ $persyaratan->nama }}</p>
                                    @if($persyaratan->deskripsi)
                                    <p class="text-xs text-text-muted mt-0.5">{{ $persyaratan->deskripsi }}</p>
                                    @endif
                                    @if($uploadedFile)
                                    <p class="text-xs text-text-muted mt-1">{{ $uploadedFile->nama_file }} • {{
                                        $uploadedFile->formatted_size }}</p>
                                    @else
                                    <p class="text-xs text-error mt-1">Belum diupload</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($uploadedFile)
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-1 bg-success/10 text-success text-xs font-medium rounded-lg">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                    Uploaded
                                </span>
                                <a href="{{ $uploadedFile->url }}" target="_blank"
                                    class="p-2 text-text-muted hover:text-primary transition-colors" title="Lihat File">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                @else
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-500 text-xs font-medium rounded-lg">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                    Pending
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-text-muted mx-auto mb-3" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <p class="text-sm text-text-muted">Tidak ada dokumen persyaratan untuk layanan ini.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - History (Shopee-style) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden sticky top-24">
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
                        <!-- Timeline Line - Shopee style with gradient -->
                        <div
                            class="absolute left-[22px] top-4 bottom-4 w-1 bg-gradient-to-b from-primary via-accent to-gray-200 rounded-full">
                        </div>

                        <!-- Timeline Items -->
                        <div class="space-y-4">
                            @foreach($histories as $index => $history)
                            <div class="relative flex items-start gap-4 group">
                                <!-- Shopee-style status icon -->
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

                                <!-- Timeline Content - Shopee card style -->
                                <div class="flex-1 min-w-0 @if($index < count($histories) - 1) pb-5 @endif">
                                    <div
                                        class="bg-gradient-to-br from-surface to-surface/50 rounded-xl p-4 border border-gray-100 group-hover:border-primary/20 group-hover:shadow-md transition-all duration-300">
                                        <!-- Title -->
                                        <p class="text-sm font-semibold text-text leading-tight">{{ $history->judul }}
                                        </p>

                                        <!-- Description -->
                                        @if($history->keterangan)
                                        <p class="text-xs text-text-muted mt-1.5 leading-relaxed">{{
                                            $history->keterangan }}</p>
                                        @endif

                                        <!-- Status Badge - Shopee style -->
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

                                        <!-- Timestamp & User - Shopee style -->
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
                    <!-- Empty State - Shopee style -->
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
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
        <a href="{{ route('user.dashboard') }}"
            class="inline-flex items-center gap-2 text-sm text-text-muted hover:text-primary transition-colors">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Dashboard
        </a>

    </div>
</div>
@endsection