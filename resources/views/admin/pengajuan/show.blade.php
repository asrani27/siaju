@extends('layouts.master')

@section('title', 'Verifikasi Pengajuan - SiAju Admin')
@section('header_title', 'Verifikasi Pengajuan')
@section('header_subtitle', $pengajuan->nomor_pengajuan)

@section('content')
<div class="mx-auto space-y-6">
    @if(session('success'))
    <div class="p-4 mb-4 bg-success/10 border border-success/20 rounded-xl text-success flex items-center gap-3">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 mb-4 bg-error/10 border border-error/20 rounded-xl text-error flex items-center gap-3">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Header Actions -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Dashboard
        </a>

        @php
        $statusConfig = [
        'draft' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'label' => 'Draft'],
        'dikirim' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Dikirim'],
        'verifikasi' => ['bg' => 'bg-warning/10', 'text' => 'text-warning', 'label' => 'Verifikasi'],
        'diproses' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600', 'label' => 'Diproses'],
        'revisi' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'label' => 'Revisi'],
        'selesai' => ['bg' => 'bg-success/10', 'text' => 'text-success', 'label' => 'Selesai'],
        'ditolak' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'label' => 'Ditolak'],
        'dibatalkan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-500', 'label' => 'Dibatalkan'],
        ];
        $status = $statusConfig[$pengajuan->status] ?? $statusConfig['draft'];
        @endphp
        <span
            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $status['bg'] }} {{ $status['text'] }}">
            {{ $status['label'] }}
        </span>
    </div>

    <!-- Verification Actions Card -->
    @if(in_array($pengajuan->status, ['dikirim', 'verifikasi', 'diproses']))
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-primary-light p-4">
            <h3 class="font-heading font-bold text-lg text-white flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Aksi Verifikasi
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.pengajuan.verifikasi', $pengajuan->id) }}" method="POST" id="verifikasiForm">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-muted mb-2">Catatan Verifikasi</label>
                        <textarea name="catatan" rows="3"
                            class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20 resize-none"
                            placeholder="Tambahkan catatan verifikasi (opsional)...">{{ old('catatan') }}</textarea>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button type="submit" name="action" value="disetujui"
                            class="px-6 py-2.5 bg-success text-white rounded-xl text-sm font-medium hover:brightness-105 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Disetujui
                        </button>
                        <button type="button" onclick="showRevisionModal()"
                            class="px-6 py-2.5 bg-warning text-white rounded-xl text-sm font-medium hover:brightness-105 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Direvisi
                        </button>
                        <button type="button" onclick="showRejectModal()"
                            class="px-6 py-2.5 bg-error text-white rounded-xl text-sm font-medium hover:brightness-105 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Ditolak
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
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
                        <p class="text-sm text-text-muted">NIK: {{ $pengajuan->user->username ?? 'N/A' }}</p>
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
                        <p class="text-base font-semibold text-text">{{ $pengajuan->tanggal_pengajuan->format('d M Y
                            H:i') }}</p>
                    </div>
                    @if($pengajuan->tanggal_selesai)
                    <div>
                        <p class="text-sm text-text-muted">Tanggal Selesai</p>
                        <p class="text-base font-semibold text-success">{{ $pengajuan->tanggal_selesai->format('d M Y
                            H:i') }}</p>
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
                <h3 class="font-heading font-bold text-lg text-text mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Dokumen Persyaratan
                </h3>
                @php
                $totalFiles = $uploadedFiles->count();
                $totalRequired = $persyaratans->count();
                @endphp
                <div class="mb-4 flex items-center gap-2">
                    <span class="text-sm text-text-muted">Progress:</span>
                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-xs">
                        <div class="bg-success h-2 rounded-full"
                            style="width: {{ $totalRequired > 0 ? ($totalFiles / $totalRequired) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-text">{{ $totalFiles }}/{{ $totalRequired }} file</span>
                </div>
                <div class="space-y-3">
                    @forelse($persyaratans as $persyaratan)
                    @php
                    $file = $uploadedFiles->get($persyaratan->id)?->first();
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
                            <div class="w-10 h-10 rounded-lg bg-error/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-error" xmlns="http://www.w3.org/2000/svg" fill="none"
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
                                <p class="text-xs text-error">Belum diupload</p>
                                @endif
                            </div>
                        </div>
                        @if($file)
                        <div class="flex items-center gap-2">
                            <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                class="p-2 rounded-lg bg-white hover:bg-primary/10 transition-smooth text-text-muted hover:text-primary">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            <a href="{{ asset('storage/' . $file->file) }}" download="{{ $file->nama_file }}"
                                class="p-2 rounded-lg bg-white hover:bg-success/10 transition-smooth text-text-muted hover:text-success">
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

            <!-- Riwayat Status -->
            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="font-heading font-bold text-lg text-text mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Riwayat Status
                </h3>
                <div class="space-y-4">
                    @forelse($histories as $history)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-8 h-8 rounded-full @if($history->status_baru == 'selesai') bg-success/10 @elseif($history->status_baru == 'ditolak' || $history->status_baru == 'revisi') bg-error/10 @else bg-primary/10 @endif flex items-center justify-center">
                                @if($history->status_baru == 'selesai')
                                <svg class="w-4 h-4 text-success" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                @elseif($history->status_baru == 'ditolak')
                                <svg class="w-4 h-4 text-error" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                @elseif($history->status_baru == 'revisi')
                                <svg class="w-4 h-4 text-warning" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @endif
                            </div>
                            @if(!$loop->last)
                            <div class="w-0.5 h-full min-h-[40px] bg-gray-200 mt-2"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-medium text-text">{{ $history->user->name ?? 'System'
                                    }}</span>
                                <span class="text-xs text-text-muted">{{ $history->created_at->format('d M Y, H:i')
                                    }}</span>
                            </div>
                            <p class="text-sm text-text">
                                Status:
                                <span class="font-medium">{{ $history->status_lama ? ucfirst($history->status_lama) : '
                                    awal' }}</span>
                                →
                                <span
                                    class="font-medium @if($history->status_baru == 'selesai') text-success @elseif($history->status_baru == 'ditolak' || $history->status_baru == 'revisi') text-error @else text-primary @endif">{{
                                    ucfirst($history->status_baru) }}</span>
                            </p>
                            @if($history->catatan)
                            <p class="text-sm text-text-muted mt-1 bg-surface p-2 rounded-lg">{{ $history->catatan }}
                            </p>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-text-muted text-center py-4">Belum ada riwayat status</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
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
                        <span class="text-sm font-semibold text-error">{{ $totalRequired - $totalFiles }}</span>
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
                        <p class="text-xs text-text-muted mt-1">{{ $revision->tanggal_revisi->format('d M Y, H:i') }}
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

<!-- Revision Modal -->
<div id="revisionModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-heading font-bold text-lg text-text flex items-center gap-2">
                <svg class="w-5 h-5 text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Minta Revisi
            </h3>
        </div>
        <form action="{{ route('admin.pengajuan.revisi', $pengajuan->id) }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-text-muted mb-2">Catatan Revisi</label>
                    <textarea name="catatan_revisi" rows="4" required
                        class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-warning/20 resize-none"
                        placeholder="Jelaskan persyaratan mana yang perlu direvisi dan alasannya..."></textarea>
                </div>
                <p class="text-xs text-text-muted">Pengajuan akan dikembalikan ke pemohon untuk direvisi.</p>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="hideRevisionModal()"
                    class="px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-warning text-white rounded-xl text-sm font-medium hover:brightness-105 transition-smooth">
                    Kirim Revisi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-heading font-bold text-lg text-text flex items-center gap-2">
                <svg class="w-5 h-5 text-error" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                Tolak Pengajuan
            </h3>
        </div>
        <form action="{{ route('admin.pengajuan.tolak', $pengajuan->id) }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-text-muted mb-2">Alasan Penolakan</label>
                    <textarea name="catatan_penolakan" rows="4" required
                        class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-error/20 resize-none"
                        placeholder="Jelaskan alasan penolakan pengajuan..."></textarea>
                </div>
                <p class="text-xs text-error">Pengajuan akan ditolak dan tidak dapat diproses lebih lanjut.</p>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="hideRejectModal()"
                    class="px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-error text-white rounded-xl text-sm font-medium hover:brightness-105 transition-smooth">
                    Tolak Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showRevisionModal() {
        document.getElementById('revisionModal').classList.remove('hidden');
        document.getElementById('revisionModal').classList.add('flex');
    }

    function hideRevisionModal() {
        document.getElementById('revisionModal').classList.add('hidden');
        document.getElementById('revisionModal').classList.remove('flex');
    }

    function showRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectModal').classList.add('flex');
    }

    function hideRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }

    // Close modals on backdrop click
    document.getElementById('revisionModal').addEventListener('click', function(e) {
        if (e.target === this) hideRevisionModal();
    });

    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) hideRejectModal();
    });

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideRevisionModal();
            hideRejectModal();
        }
    });
</script>
@endpush