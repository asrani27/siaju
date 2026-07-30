@extends('layouts.master')

@section('title', 'Dashboard User')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'Selamat datang kembali')

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
                    <h3 class="font-heading font-bold text-2xl lg:text-4xl">Halo, {{ auth()->user()->name ?? 'Pengguna'
                        }}!</h3>
                    <p class="text-white/80 max-w-xl text-sm lg:text-base">Kelola pengajuan layanan administrasi Anda
                        dengan mudah. Pantau status dan ajukan permohonan baru kapan saja.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('user.pengajuan.create') }}"
                        class="px-6 py-3 bg-white text-primary font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Ajukan Baru
                    </a>
                    {{-- <a href="{{ route('user.pengajuan.index') }}"
                        class="px-6 py-3 bg-white/10 backdrop-blur text-white font-semibold rounded-xl hover:bg-white/20 transition-all border border-white/20 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                        Lihat Layanan
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12">
        <!-- Recent Pengajuan -->
        <div class="xl:col-span-12 bg-white rounded-2xl shadow-card overflow-hidden animate-slide-up"
            style="animation-delay: 0.3s">
            <div
                class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h5 class="font-heading font-bold text-lg text-text">Pengajuan Terkini</h5>
                    <p class="text-sm text-text-muted">Riwayat pengajuan layanan Anda</p>
                </div>
                <a href="{{ route('user.pengajuan.index') }}"
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
                                    <a href="{{ asset('storage/' . $pengajuan->sk_file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-success/10 hover:bg-success/20 border border-success/20 hover:border-success text-success transition-smooth text-xs font-medium"
                                        title="Lihat SK">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Lihat SK
                                    </a>
                                    <a href="{{ asset('storage/' . $pengajuan->sk_file) }}"
                                        download="{{ basename($pengajuan->sk_file) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-success/10 hover:bg-success/20 border border-success/20 hover:border-success text-success transition-smooth text-xs font-medium"
                                        title="Download SK">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download SK
                                    </a>
                                    @endif
                                    @if($pengajuan->status === 'draft')
                                    <form action="{{ route('user.pengajuan.destroy', $pengajuan) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-error/10 hover:bg-error/20 border border-error/20 hover:border-error text-error hover:text-error transition-smooth text-xs font-medium"
                                            title="Hapus">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ route('user.pengajuan.show', $pengajuan) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 hover:bg-accent/20 border border-gray-200 hover:border-accent text-gray-600 hover:text-accent transition-smooth text-xs font-medium"
                                        title="Lihat Detail">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Dokumen Persyaratan
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center text-text-muted">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p class="text-sm">Belum ada pengajuan</p>
                                    <a href="{{ route('user.pengajuan.index') }}"
                                        class="mt-2 text-primary hover:underline text-sm">Ajukan sekarang</a>
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
        <p>© 2026 SiAju - Sistem Informasi Administratif Warga.</p>
        <div class="flex items-center gap-6">
            <a class="hover:text-primary transition-colors" href="#">Bantuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-primary transition-colors" href="#">Hubungi Kami</a>
        </div>
    </footer>
</div>
@endsection