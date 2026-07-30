@extends('layouts.master')

@section('title', 'Data Pegawai - SKPD')
@section('header_title', 'Data Pegawai')
@section('header_subtitle', 'Kelola data pegawai {{ $skpd->nama_skpd ?? "SKPD" }}')

@section('content')
<div class="mx-auto space-y-6 lg:space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="font-heading font-bold text-2xl text-text">Data Pegawai</h3>
            <p class="text-text-muted text-sm mt-1">Daftar pegawai {{ $skpd->nama_skpd ?? "SKPD" }}</p>
        </div>
        <a href="{{ route('skpd.pegawai.create') }}"
            class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Pegawai
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="bg-success/10 border border-success/20 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-success flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="text-success font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-error/10 border border-error/20 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-error flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <span class="text-error font-medium">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Search -->
    <div class="bg-white rounded-2xl shadow-card p-4">
        <form method="GET" action="{{ route('skpd.pegawai.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input name="search" type="text" value="{{ request('search') }}" placeholder="Cari nama atau NIP..." 
                    class="w-full pl-12 pr-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20">
            </div>
            <button type="submit" class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:brightness-105 transition-all">
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('skpd.pegawai.index') }}" class="px-6 py-3 bg-gray-100 text-text font-semibold rounded-xl hover:bg-gray-200 transition-all">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">No. Telepon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-text-muted uppercase tracking-wider">Status Akun</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-text-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pegawai as $key => $item)
                    <tr class="hover:bg-surface/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-text-muted">{{ $pegawai->firstItem() + $key }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-text">{{ $item->nip }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-semibold">
                                    {{ substr($item->nama, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-text">{{ $item->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-muted">{{ $item->telp ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($item->user)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-success/10 text-success">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-warning/10 text-warning">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728 5.664-5.664m-12.728 0a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                </svg>
                                Belum Aktif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('skpd.pegawai.show', $item) }}"
                                    class="p-2 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition-colors" title="Detail">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('skpd.pegawai.edit', $item) }}"
                                    class="p-2 rounded-lg bg-warning/10 text-warning hover:bg-warning/20 transition-colors" title="Edit">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('skpd.pegawai.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 rounded-lg bg-error/10 text-error hover:bg-error/20 transition-colors delete-btn" title="Hapus">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center text-text-muted">
                                <svg class="w-12 h-12 mb-3 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <p class="text-sm">Belum ada data pegawai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pegawai->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $pegawai->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
