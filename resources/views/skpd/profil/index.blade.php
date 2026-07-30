@extends('layouts.master')

@section('title', 'Profil - SKPD')
@section('header_title', 'Profil')
@section('header_subtitle', 'Kelola profil dan password')

@section('content')
<div class="mx-auto space-y-6 lg:space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="font-heading font-bold text-2xl text-text">Profil</h3>
            <p class="text-text-muted text-sm mt-1">Kelola informasi profil dan password</p>
        </div>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
        <!-- Profile Info -->
        <div class="bg-white rounded-2xl shadow-card p-6 lg:p-8">
            <h4 class="font-heading font-bold text-lg text-text mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                Informasi Profil
            </h4>

            <form action="{{ route('skpd.profil.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 rounded-2xl bg-primary/10 flex items-center justify-center text-primary text-3xl font-bold mb-4">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-semibold rounded-full">
                        {{ $user->role === 'skpd' ? 'Admin SKPD' : ucfirst($user->role) }}
                    </span>
                </div>

                <div>
                    <label for="name" class="block text-sm font-semibold text-text mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('name') ring-2 ring-error @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-text mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('email') ring-2 ring-error @enderror"
                        placeholder="Masukkan email">
                    @error('email')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text mb-2">Username</label>
                    <input type="text" value="{{ $user->username }}" disabled
                        class="w-full px-4 py-3 bg-gray-100 rounded-xl border-0 text-text-muted cursor-not-allowed"
                        placeholder="Username tidak dapat diubah">
                    <p class="mt-1 text-xs text-text-muted">Username digunakan untuk login dan tidak dapat diubah.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text mb-2">SKPD</label>
                    <input type="text" value="{{ $skpd->nama_skpd ?? '-' }}" disabled
                        class="w-full px-4 py-3 bg-gray-100 rounded-xl border-0 text-text cursor-not-allowed">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-primary/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-2xl shadow-card p-6 lg:p-8">
            <h4 class="font-heading font-bold text-lg text-text mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                Ubah Password
            </h4>

            <form action="{{ route('skpd.profil.password') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-text mb-2">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password" required
                            class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('current_password') ring-2 ring-error @enderror"
                            placeholder="Masukkan password saat ini">
                        <button type="button" onclick="togglePassword('current_password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text">
                            <svg class="w-5 h-5 toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-text mb-2">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20 @error('password') ring-2 ring-error @enderror"
                            placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text">
                            <svg class="w-5 h-5 toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-text mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 bg-surface rounded-xl border-0 text-text placeholder-text-muted focus:ring-2 focus:ring-primary/20"
                            placeholder="Ulangi password baru">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text">
                            <svg class="w-5 h-5 toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full px-6 py-3 bg-warning text-white font-semibold rounded-xl hover:brightness-105 transition-all shadow-lg shadow-warning/20">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('.toggle-icon') || input.parentElement.querySelector('.toggle-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
        }
    }
</script>
@endpush
