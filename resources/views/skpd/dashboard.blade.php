@extends('layouts.master')

@section('title', 'Dashboard SKPD')
@section('header_title', 'Dashboard SKPD')
@section('header_subtitle', 'Selamat datang di Dashboard SKPD')

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
                        <span class="text-white/90">Layanan tersedia 24/7</span>
                    </div>
                    <h3 class="font-heading font-bold text-2xl lg:text-4xl">Halo, {{ auth()->user()->name ?? 'Admin SKPD' }}!</h3>
                    <p class="text-white/80 max-w-xl text-sm lg:text-base">
                        Kelola pengajuan layanan administrasi {{ $skpd->nama_skpd ?? 'SKPD' }} Anda. 
                        Pantau status dan lihat pengajuan dari seluruh pegawai.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('skpd.pengajuan.create') }}"
                        class="px-6 py-3 bg-white text-primary font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Ajukan Baru
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <div class="bg-white rounded-2xl shadow-card p-6 animate-slide-up" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-text-muted mb-1">Total Pengajuan</p>
            <p class="text-3xl font-bold text-text">{{ $stats['total'] ?? 0 }}</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-card p-6 animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-warning/10 flex items-center justify-center text-warning">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-text-muted mb-1">Dalam Proses</p>
            <p class="text-3xl font-bold text-text">{{ $stats['dalam_proses'] ?? 0 }}</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-card p-6 animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-success/10 flex items-center justify-center text-success">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-text-muted mb-1">Selesai (Bulan Ini)</p>
            <p class="text-3xl font-bold text-text">{{ $stats['selesai'] ?? 0 }}</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-card p-6 animate-slide-up" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-error/10 flex items-center justify-center text-error">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-text-muted mb-1">Perlu Revisi</p>
            <p class="text-3xl font-bold text-text">{{ $stats['perlu_revisi'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12">
        <!-- Recent Pengajuan -->
        <div class="xl:col-span-12 bg-white rounded-2xl shadow-card overflow-hidden animate-slide-up"
            style="animation-delay: 0.5s">
            <div
                class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h5 class="font-heading font-bold text-lg text-text">Pengajuan Terkini</h5>
                    <p class="text-sm text-text-muted">Riwayat pengajuan dari seluruh pegawai SKPD</p>
                </div>
                <a href="{{ route('skpd.pengajuan.index') }}"
                    class="text-accent hover:text-primary text-sm font-medium transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                                Jenis Layanan</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                                Pemohon</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-text-muted uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPengajuan as $pengajuan)
                        <tr class="hover:bg-surface/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-text">{{ $pengajuan->layanan->nama ??
                                            'Layanan' }}</p>
                                        <p class="text-xs text-text-muted">{{ $pengajuan->nomor_pengajuan }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-text">{{ $pengajuan->user->name ?? '-' }}</p>
                                <p class="text-xs text-text-muted">{{ $pengajuan->user->username ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-muted">{{ $pengajuan->tanggal_pengajuan->format('d M
                                Y') }}</td>
                            <td class="px-6 py-4">
                                @if($pengajuan->status === 'selesai')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-success/10 text-success">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Selesai
                                </span>
                                @elseif($pengajuan->status === 'revisi')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-error/10 text-error">
                                    <span class="w-1.5 h-1.5 rounded-full bg-error mr-1.5"></span>
                                    Perlu Revisi
                                </span>
                                @elseif(in_array($pengajuan->status, ['dikirim', 'verifikasi', 'diproses']))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-warning/10 text-warning">
                                    <span class="w-1.5 h-1.5 rounded-full bg-warning mr-1.5 animate-pulse"></span>
                                    {{ $pengajuan->getStatusLabel() }}
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                                    {{ $pengajuan->getStatusLabel() }}
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($pengajuan->status === 'selesai' && $pengajuan->sk_file)
                                        @include('skpd.partials.action-view-sk')
                                        @include('skpd.partials.action-download-sk')
                                    @endif
                                    @include('skpd.partials.action-detail')
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center text-text-muted">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p class="text-sm">Belum ada pengajuan dari pegawai SKPD</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer
        class="pt-6 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-text-muted">
        <p>© 2024 SiAju - Sistem Informasi Administratif Warga.</p>
        <div class="flex items-center gap-6">
            <a class="hover:text-primary transition-colors" href="#">Bantuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-primary transition-colors" href="#">Hubungi Kami</a>
        </div>
    </footer>
</div>
@endsection
