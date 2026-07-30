@extends('layouts.master')

@section('title', 'Dashboard - SiAju Admin')
@section('header_title', 'Dashboard Utama')
@section('header_subtitle', 'Selamat datang kembali, Admin Utama')

@section('content')
<div class="mx-auto space-y-6 lg:space-y-8">
    <!-- Welcome Banner -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-primary via-primary-light to-accent rounded-2xl lg:rounded-3xl p-6 lg:p-10 text-white animate-fade-in">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200">
                <circle cx="350" cy="50" r="100" fill="white" />
                <circle cx="320" cy="150" r="80" fill="white" />
                <circle cx="50" cy="150" r="60" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 rounded-full text-sm">
                        <span class="w-2 h-2 bg-success rounded-full animate-pulse-soft"></span>
                        <span class="text-white/90">{{ $stats['menunggu'] }} pengajuan memerlukan tindakan</span>
                    </div>
                    <h3 class="font-heading font-bold text-2xl lg:text-4xl">Selamat Datang, Admin!</h3>
                    <p class="text-white/80 max-w-xl text-sm lg:text-base">Kelola data administrasi dan layanan publik
                        wilayah Anda secara efisien. Sistem berjalan normal dengan performa optimal.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.pengajuan.index') }}"
                        class="px-6 py-3 bg-secondary-light text-primary font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-secondary/20 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Tinjau Pengajuan
                    </a>
                    {{-- <button
                        class="px-6 py-3 bg-white/10 backdrop-blur text-white font-semibold rounded-xl hover:bg-white/20 transition-all border border-white/20 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Unduh Rekap
                    </button> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl shadow-card p-5 animate-slide-up" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-muted">Total Pengajuan</p>
                    <p class="text-2xl font-bold text-text mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-5 animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-muted">Bulan Ini</p>
                    <p class="text-2xl font-bold text-text mt-1">{{ $stats['bulan_ini'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-5 animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-muted">Sedang Diproses</p>
                    <p class="text-2xl font-bold text-warning mt-1">{{ $stats['diproses'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-warning/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-5 animate-slide-up" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-muted">Selesai</p>
                    <p class="text-2xl font-bold text-success mt-1">{{ $stats['selesai'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-success/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-card overflow-hidden animate-slide-up" style="animation-delay: 0.6s">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h5 class="font-heading font-bold text-lg text-text">Daftar Pengajuan Terkini</h5>
                <p class="text-sm text-text-muted">{{ $stats['bulan_ini'] }} pengajuan bulan ini</p>
            </div>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="relative">
                    <input name="search" value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20 w-48"
                        placeholder="Cari..." type="text">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-text-muted"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <select name="status"
                    class="px-4 py-2 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20">
                    <option value="">Semua Status</option>
                    <option value="dikirim" {{ request('status')=='dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="verifikasi" {{ request('status')=='verifikasi' ? 'selected' : '' }}>Verifikasi
                    </option>
                    <option value="diproses" {{ request('status')=='diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="revisi" {{ request('status')=='revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button type="submit"
                    class="px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth flex items-center gap-2">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.dashboard') }}"
                    class="px-4 py-2 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
                    Reset
                </a>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Nama Pemohon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Jenis Layanan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Tanggal Masuk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengajuans as $pengajuan)
                    <tr class="hover:bg-surface/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                    {{ substr($pengajuan->user->name ?? 'N', 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-text">{{ $pengajuan->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-text-muted">NIK: {{ substr($pengajuan->user->username ??
                                        '0000000000000000', 0, 4) . '**********' . substr($pengajuan->user->username ??
                                        '0000', -4) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text">{{ $pengajuan->layanan->nama ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-text-muted">{{ $pengajuan->tanggal_pengajuan->format('d M Y')
                            }}</td>
                        <td class="px-6 py-4">
                            @php
                            $statusConfig = [
                            'draft' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'icon' => '', 'label' =>
                            'Draft'],
                            'dikirim' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'icon' => '', 'label' =>
                            'Dikirim'],
                            'verifikasi' => ['bg' => 'bg-warning/10', 'text' => 'text-warning', 'icon' =>
                            'animate-pulse', 'label' => 'Verifikasi'],
                            'diproses' => ['bg' => 'bg-warning/10', 'text' => 'text-warning', 'icon' => 'animate-pulse',
                            'label' => 'Diproses'],
                            'revisi' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'icon' => '', 'label' => 'Perlu
                            Revisi'],
                            'selesai' => ['bg' => 'bg-success/10', 'text' => 'text-success', 'icon' => '✓', 'label' =>
                            'Selesai'],
                            'ditolak' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'icon' => '✗', 'label' =>
                            'Ditolak'],
                            'dibatalkan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-500', 'icon' => '', 'label' =>
                            'Dibatalkan'],
                            ];
                            $status = $statusConfig[$pengajuan->status] ?? $statusConfig['draft'];
                            @endphp
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $status['bg'] }} {{ $status['text'] }}">
                                @if($status['icon'] && $status['icon'] !== 'animate-pulse')
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @elseif(in_array($pengajuan->status, ['verifikasi', 'diproses']))
                                <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5 {{ $status['icon'] }}"></span>
                                @elseif($pengajuan->status == 'revisi')
                                <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                @endif
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($pengajuan->status == 'dikirim')
                            {{-- Tombol Proses: mengubah status menjadi diproses dan menyimpan ke pengajuan_history --}}
                            <form action="{{ route('admin.pengajuan.prosesVerifikasi', $pengajuan->id) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1.5 rounded-lg bg-primary/10 hover:bg-primary text-primary hover:text-white text-sm font-medium transition-smooth flex items-center gap-1.5 inline-flex">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                    </svg>
                                    Proses
                                </button>
                            </form>
                            @elseif($pengajuan->status == 'diproses')
                            {{-- Tombol Verifikasi: langsung menampilkan halaman show tanpa mengubah status --}}
                            <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}"
                                class="px-3 py-1.5 rounded-lg bg-success/10 hover:bg-success text-success hover:text-white text-sm font-medium transition-smooth flex items-center gap-1.5 inline-flex">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Verifikasi
                            </a>
                            @elseif(in_array($pengajuan->status, ['selesai', 'ditolak', 'revisi']))
                            {{-- Tombol Show: menampilkan halaman detail pengajuan --}}
                            <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}"
                                class="px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 text-sm font-medium transition-smooth flex items-center gap-1.5 inline-flex">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Detail
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <p class="text-text-muted text-sm">Belum ada pengajuan masuk</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 lg:p-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-text-muted">
                Menampilkan {{ $pengajuans->firstItem() ?? 0 }}-{{ $pengajuans->lastItem() ?? 0 }} dari {{
                $pengajuans->total() }} pengajuan
            </p>
            <div class="flex items-center gap-2">
                @if($pengajuans->onFirstPage())
                <button class="p-2 rounded-xl border border-gray-200 cursor-not-allowed opacity-50" disabled>
                    <svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
                @else
                <a href="{{ $pengajuans->previousPageUrl() }}"
                    class="p-2 rounded-xl border border-gray-200 hover:bg-surface transition-smooth">
                    <svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </a>
                @endif

                @foreach($pengajuans->getUrlRange(max(1, $pengajuans->currentPage() - 2), min($pengajuans->lastPage(),
                $pengajuans->currentPage() + 2)) as $page => $url)
                @if($page == $pengajuans->currentPage())
                <button class="w-10 h-10 rounded-xl bg-primary text-white font-bold text-sm">{{ $page }}</button>
                @else
                <a href="{{ $url }}"
                    class="w-10 h-10 rounded-xl border border-gray-200 hover:bg-surface text-sm font-medium text-text transition-smooth">{{
                    $page }}</a>
                @endif
                @endforeach

                @if($pengajuans->hasMorePages())
                <a href="{{ $pengajuans->nextPageUrl() }}"
                    class="p-2 rounded-xl border border-gray-200 hover:bg-surface transition-smooth">
                    <svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
                @else
                <button class="p-2 rounded-xl border border-gray-200 cursor-not-allowed opacity-50" disabled>
                    <svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer
        class="pt-6 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-text-muted">
        <p>© 2026 SiAju Admin - Sistem Informasi Administratif Terintegrasi.</p>
        <div class="flex items-center gap-6">
            <a class="hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-primary transition-colors" href="#">Log Sistem</a>
        </div>
    </footer>
</div>
@endsection

@push('scripts')
<script>
    // Auto-submit form on filter change
    document.querySelector('select[name="status"]').addEventListener('change', function() {
        this.closest('form').submit();
    });
</script>
@endpush