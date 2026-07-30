@extends('layouts.master')

@section('title', 'Detail Pegawai - SKPD')
@section('header_title', 'Detail Pegawai')
@section('header_subtitle', 'Lihat detail data pegawai')

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
            <h3 class="font-heading font-bold text-2xl text-text">Detail Pegawai</h3>
            <p class="text-text-muted text-sm mt-1">Lihat detail data pegawai</p>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white rounded-2xl shadow-card p-6 lg:p-8">
        <div class="flex flex-col items-center mb-8">
            <div class="w-24 h-24 rounded-2xl bg-primary/10 flex items-center justify-center text-primary text-3xl font-bold mb-4">
                {{ substr($pegawai->nama, 0, 1) }}
            </div>
            <h4 class="text-xl font-bold text-text">{{ $pegawai->nama }}</h4>
            <p class="text-text-muted">{{ $pegawai->nip }}</p>
            @if($pegawai->user)
            <span class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-success/10 text-success">
                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Akun Aktif
            </span>
            @else
            <span class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-warning/10 text-warning">
                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728 5.664-5.664m-12.728 0a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                </svg>
                Belum Memiliki Akun
            </span>
            @endif
        </div>

        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 p-4 bg-surface rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <span class="text-sm text-text-muted">NIP</span>
                </div>
                <span class="sm:ml-auto font-semibold text-text">{{ $pegawai->nip }}</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 p-4 bg-surface rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <span class="text-sm text-text-muted">Nama Lengkap</span>
                </div>
                <span class="sm:ml-auto font-semibold text-text">{{ $pegawai->nama }}</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 p-4 bg-surface rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <span class="text-sm text-text-muted">Nomor Telepon</span>
                </div>
                <span class="sm:ml-auto font-semibold text-text">{{ $pegawai->telp ?? '-' }}</span>
            </div>

            @if($pegawai->user)
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 p-4 bg-surface rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <span class="text-sm text-text-muted">Username Akun</span>
                </div>
                <span class="sm:ml-auto font-semibold text-text">{{ $pegawai->user->username }}</span>
            </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-100">
            <a href="{{ route('skpd.pegawai.index') }}" class="px-6 py-3 bg-gray-100 text-text font-semibold rounded-xl hover:bg-gray-200 transition-all">
                Kembali
            </a>
            <a href="{{ route('skpd.pegawai.edit', $pegawai) }}" class="px-6 py-3 bg-warning text-white font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-warning/20">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
