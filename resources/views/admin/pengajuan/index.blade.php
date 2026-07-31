@extends('layouts.master')

@section('title', 'Kelola Pengajuan - SiAju Admin')
@section('header_title', 'Kelola Pengajuan')
@section('header_subtitle', 'Kelola dan proses pengajuan layanan')

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

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Total</p>
                    <p class="text-xl font-bold text-text">{{ $stats['total'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Menunggu</p>
                    <p class="text-xl font-bold text-warning">{{ $stats['menunggu'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-warning/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Diproses</p>
                    <p class="text-xl font-bold text-accent">{{ $stats['diproses'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-accent" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Revisi</p>
                    <p class="text-xl font-bold text-error">{{ $stats['revisi'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-error/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-error" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Selesai</p>
                    <p class="text-xl font-bold text-success">{{ $stats['selesai'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-success/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-text-muted">Ditolak</p>
                    <p class="text-xl font-bold text-error">{{ $stats['ditolak'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-error/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-error" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl shadow-card p-6">
        <form method="GET" action="{{ route('admin.pengajuan.index') }}" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-text-muted mb-2">Cari</label>
                <div class="relative">
                    <input name="search" value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20 w-full"
                        placeholder="Nomor pengajuan, nama, NIP..." type="text">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-text-muted"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
            <div class="w-40">
                <label class="block text-sm font-medium text-text-muted mb-2">Status</label>
                <select name="status"
                    class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
                    <option value="dikirim" {{ request('status')=='dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="verifikasi" {{ request('status')=='verifikasi' ? 'selected' : '' }}>Verifikasi
                    </option>
                    <option value="diproses" {{ request('status')=='diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="revisi" {{ request('status')=='revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="dibatalkan" {{ request('status')=='dibatalkan' ? 'selected' : '' }}>Dibatalkan
                    </option>
                </select>
            </div>
            <div class="w-36">
                <label class="block text-sm font-medium text-text-muted mb-2">Dari Tanggal</label>
                <input name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                    class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20"
                    type="date">
            </div>
            <div class="w-36">
                <label class="block text-sm font-medium text-text-muted mb-2">Sampai Tanggal</label>
                <input name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                    class="w-full px-4 py-2.5 bg-surface rounded-xl text-sm border-0 focus:ring-2 focus:ring-accent/20"
                    type="date">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-medium hover:brightness-105 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.pengajuan.index') }}"
                    class="px-5 py-2.5 bg-surface hover:bg-surface-high rounded-xl text-sm font-medium text-text transition-smooth">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            No. Pengajuan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Pemohon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Layanan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-text-muted uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengajuans as $item)
                    <tr class="hover:bg-surface/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-primary">{{ $item->nomor_pengajuan }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                    {{ substr($item->user->name ?? 'N', 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-text">{{ $item->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-text-muted">NIP: {{ substr($item->user->username ??
                                        '0000000000000000', 0, 4) . '**********' . substr($item->user->nik ?? '0000',
                                        -4) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text">{{ $item->layanan->nama ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-text-muted">{{ $item->tanggal_pengajuan->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $statusConfig = [
                            'draft' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'label' => 'Draft'],
                            'dikirim' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Dikirim'],
                            'verifikasi' => ['bg' => 'bg-warning/10', 'text' => 'text-warning', 'label' =>
                            'Verifikasi'],
                            'diproses' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600', 'label' => 'Diproses'],
                            'revisi' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'label' => 'Revisi'],
                            'selesai' => ['bg' => 'bg-success/10', 'text' => 'text-success', 'label' => 'Selesai'],
                            'ditolak' => ['bg' => 'bg-error/10', 'text' => 'text-error', 'label' => 'Ditolak'],
                            'dibatalkan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-500', 'label' => 'Dibatalkan'],
                            ];
                            $status = $statusConfig[$item->status] ?? $statusConfig['draft'];
                            @endphp
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $status['bg'] }} {{ $status['text'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.pengajuan.show', $item->id) }}"
                                    class="p-2 rounded-lg bg-surface hover:bg-accent/10 text-text-muted hover:text-accent transition-smooth"
                                    title="Detail">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <p class="text-text-muted text-sm">Tidak ada data pengajuan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pengajuans->hasPages())
        <div class="p-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
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
        @endif
    </div>
</div>
@endsection