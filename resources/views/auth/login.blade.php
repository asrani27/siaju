<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk | SiAju SKPP</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#a8f1e0",
                        "primary-fixed-dim": "#9cd1c3",
                        "tertiary": "#00251f",
                        "primary-container": "#003d33",
                        "on-surface": "#191c1d",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#edeeef",
                        "on-surface-variant": "#404946",
                        "surface-tint": "#34675c",
                        "surface-container-low": "#f3f4f5",
                        "on-tertiary-fixed": "#00201b",
                        "surface": "#f8f9fa",
                        "surface-dim": "#d9dadb",
                        "surface-container-high": "#e7e8e9",
                        "error": "#ba1a1a",
                        "surface-bright": "#f8f9fa",
                        "primary-fixed": "#b8eddf",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#ffdfa0",
                        "secondary": "#795900",
                        "surface-container-highest": "#e1e3e4",
                        "tertiary-fixed-dim": "#8cd4c4",
                        "on-tertiary-fixed-variant": "#005046",
                        "secondary-fixed-dim": "#f6be39",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#75a89b",
                        "on-background": "#191c1d",
                        "inverse-primary": "#9cd1c3",
                        "on-secondary": "#ffffff",
                        "tertiary-container": "#003d34",
                        "primary": "#00251e",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "background": "#f8f9fa",
                        "inverse-surface": "#2e3132",
                        "surface-variant": "#e1e3e4",
                        "on-tertiary-container": "#63ab9c",
                        "outline": "#707976",
                        "on-primary-fixed-variant": "#1a4f44",
                        "on-secondary-fixed": "#261a00",
                        "on-secondary-container": "#715300",
                        "on-secondary-fixed-variant": "#5c4300",
                        "secondary-container": "#ffc641",
                        "outline-variant": "#c0c8c4",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#00201a",
                        "inverse-on-surface": "#f0f1f2"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "sidebar-width": "260px",
                        "base": "4px",
                        "margin-desktop": "32px"
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "headline-lg-mobile": ["Manrope"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Manrope"],
                        "label-sm": ["Inter"],
                        "headline-xl": ["Manrope"],
                        "headline-md": ["Manrope"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-xl": ["40px", {"lineHeight": "52px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body-md min-h-screen flex">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-secondary rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-tertiary-fixed rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2">
            </div>
        </div>
        <div class="relative z-10 flex flex-col justify-between p-12 w-full">
            <div class="flex items-center gap-3">
                <img alt="SiAju SKPP Logo" class="h-12 w-auto brightness-0 invert"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuATm778DoYQoQI0DRrQkR9is3lYMHjj_X2f44ilX4DKPfHuUqIeoPt1nM-xAD-RTr0o94gg90VS8snkRsahFf4XED83EFqAV6nJVJ4DWUVq-k2kJrbj0qARIfKO1Qt9qiDcWLUQ3CnbuT2XoYuSAPWgsOGucU719UOwr9Qb-gxNGw5fKSN47otnp04bMgLw-6UlPt_8WrHqk3Cz4n-lnKFET0Jrpp7BGtkx7BVNQQRta333v5soUqXHuDhXVUlJEx4WFK3QTnGwguM" />
                <span class="font-headline-md text-headline-md text-white font-bold">SiAju SKPP</span>
            </div>

            <div class="space-y-8">
                <h1 class="font-headline-xl text-headline-xl text-white leading-tight">
                    Selamat Datang<br />
                    <span class="text-secondary-fixed">di SiAju SKPP</span>
                </h1>
                <p class="text-body-lg text-white/80 max-w-md">
                    Masuk ke akun Anda untuk mengajukan berkas SKPP secara online.
                </p>

                {{-- <div class="flex items-center gap-6 pt-4">
                    <div class="flex -space-x-3">
                        <div
                            class="w-12 h-12 rounded-full border-2 border-primary bg-surface-container flex items-center justify-center overflow-hidden">
                            <img class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxtBoMNLPhyzDvCHEXbykq57skVfjhVFe3VFo5RPh83XO3Oq5cMWH7kic_RqdHzEtMt8yJudFBo6MQBdYsLMTz4tHPZam6nvcqdVDlpl5FPQRTlabrc9bft9Me2wvtLjW4B8_Q6iUI81FTuAl4ob30utiPBcuuO_hI_lycBGmP8Bd8Ompp1BPJ3wTiJGICsLIp-wBH5DHLUfFLvb8wDb2iGlITf5Es36czIm6LWL7rp14XDLk_dkGiE2X43c34KhYtd0ApMq5ReEA" />
                        </div>
                        <div
                            class="w-12 h-12 rounded-full border-2 border-primary bg-surface-container flex items-center justify-center overflow-hidden">
                            <img class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7YELkXJlhIsc5qEzZbCLRWIJr0u3DSyIZKttQhtLhava5_xhUL4cldIXd5YOLBLejpCeVXOAKfEmVIVZK_2E7chY2-KqIe6UNwXKm-nQsiWvbH-Dy3wVHCeQ6AlRiPD5UFF9rTv1q8Oeq_Gn43NWMKY9eDbrXVwcd4eviaslEJBgvcA7SC-Im4gRt8Y1a76b1LUB-B0TLuT9P_8htSQFthMAQLXY7654sl49VrTLzgh_u-EhEExcBD2NOLI0t4t8s4aqQipQlo0s" />
                        </div>
                        <div
                            class="w-12 h-12 rounded-full border-2 border-primary bg-secondary flex items-center justify-center">
                            <span class="text-[10px] text-on-secondary font-bold">+5k</span>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-white/80">
                        Telah dipercaya oleh <span class="text-secondary-fixed font-bold">5,000+</span> warga
                    </p>
                </div> --}}
            </div>

            <div class="space-y-2">
                <div class="flex items-center gap-3 text-white/60">
                    <span class="material-symbols-outlined text-secondary-fixed">verified_badge</span>
                    <span class="font-label-sm text-label-sm">Data aman dan terlindungi</span>
                </div>
                {{-- <div class="flex items-center gap-3 text-white/60">
                    <span class="material-symbols-outlined text-secondary-fixed">support_agent</span>
                    <span class="font-label-sm text-label-sm">Bantuan 24/7 tersedia</span>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                <img alt="SiAju SKPP Logo" class="h-10 w-auto"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuATm778DoYQoQI0DRrQkR9is3lYMHjj_X2f44ilX4DKPfHuUqIeoPt1nM-xAD-RTr0o94gg90VS8snkRsahFf4XED83EFqAV6nJVJ4DWUVq-k2kJrbj0qARIfKO1Qt9qiDcWLUQ3CnbuT2XoYuSAPWgsOGucU719UOwr9Qb-gxNGw5fKSN47otnp04bMgLw-6UlPt_8WrHqk3Cz4n-lnKFET0Jrpp7BGtkx7BVNQQRta333v5soUqXHuDhXVUlJEx4WFK3QTnGwguM" />
                <span class="font-headline-md text-headline-md text-primary font-bold">SiAju SKPP</span>
            </div>

            <div class="text-center lg:text-left">
                <h2 class="font-headline-lg text-headline-lg text-primary">Masuk ke Akun</h2>
                <p class="mt-2 text-body-md text-on-surface-variant">
                    Masukkan username dan password Anda untuk melanjutkan
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-error-container border border-error/20 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-error">error</span>
                    <div class="flex-1">
                        @foreach ($errors->all() as $error)
                        <p class="text-sm text-error font-label-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="font-label-md text-label-md text-on-surface font-semibold">
                        Username
                    </label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">person</span>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            class="w-full pl-12 pr-4 py-3.5 bg-surface-container border border-outline rounded-lg text-on-surface placeholder-on-surface-variant focus:outline-none focus:ring-2 focus:ring-surface-tint focus:border-surface-tint transition-all font-body-md text-body-md @error('username') border-error focus:ring-error @enderror"
                            required autofocus />
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="font-label-md text-label-md text-on-surface font-semibold">
                        Password
                    </label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                        <input type="password" id="password" name="password" placeholder="Masukkan password"
                            class="w-full pl-12 pr-12 py-3.5 bg-surface-container border border-outline rounded-lg text-on-surface placeholder-on-surface-variant focus:outline-none focus:ring-2 focus:ring-surface-tint focus:border-surface-tint transition-all font-body-md text-body-md @error('password') border-error focus:ring-error @enderror"
                            required />
                        <button type="button" id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-outline text-primary focus:ring-surface-tint cursor-pointer">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Ingat saya</span>
                    </label>
                    <a href="#"
                        class="font-label-sm text-label-sm text-surface-tint hover:text-primary transition-colors">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3.5 bg-primary text-on-primary font-label-md text-label-md rounded-lg hover:bg-primary/90 active:opacity-80 scale-95 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    Masuk
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-outline-variant"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-surface px-4 font-label-sm text-label-sm text-on-surface-variant">
                        atau
                    </span>
                </div>
            </div>

            <!-- Register Link -->
            <p class="text-center text-body-md text-on-surface-variant">
                Belum punya akun?
                <a href="#"
                    class="font-label-md text-label-md text-surface-tint hover:text-primary font-semibold transition-colors">
                    Daftar Sekarang
                </a>
            </p>

            <!-- Back to Home -->
            <div class="text-center pt-4">
                <a href="/"
                    class="inline-flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.textContent = 'visibility_off';
            } else {
                eyeIcon.textContent = 'visibility';
            }
        });
    </script>
</body>

</html>