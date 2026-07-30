<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SiAju SKPP | Pengajuan Berkas Secara Online</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@100..900&display=swap"
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

        .joglo-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(0, 37, 30, 0.03) 1px, transparent 0);
            background-size: 32px 32px;
        }

        .gradient-overlay {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(248, 249, 250, 1) 100%);
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">
    <!-- TopNavBar -->
    <nav
        class="fixed top-0 w-full z-50 bg-surface dark:bg-on-background border-b border-outline-variant dark:border-outline">
        <div class="flex justify-between items-center px-margin-desktop h-20 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <img alt="SiAju SKPP Logo" class="h-10 w-auto"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuATm778DoYQoQI0DRrQkR9is3lYMHjj_X2f44ilX4DKPfHuUqIeoPt1nM-xAD-RTr0o94gg90VS8snkRsahFf4XED83EFqAV6nJVJ4DWUVq-k2kJrbj0qARIfKO1Qt9qiDcWLUQ3CnbuT2XoYuSAPWgsOGucU719UOwr9Qb-gxNGw5fKSN47otnp04bMgLw-6UlPt_8WrHqk3Cz4n-lnKFET0Jrpp7BGtkx7BVNQQRta333v5soUqXHuDhXVUlJEx4WFK3QTnGwguM" />
                <span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed">SiAju
                    SKPP</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-primary text-on-primary font-label-md text-label-md rounded-lg Active:opacity-80 scale-95 transition-all cursor-pointer">Masuk</a>
                <button class="md:hidden text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </nav>
    <main class="mt-20">
        <!-- Hero Section -->
        <section class="relative min-h-[85vh] flex items-center pt-12 overflow-hidden joglo-pattern">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <img alt="" class="w-full h-full object-contain transform translate-x-1/4"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuATm778DoYQoQI0DRrQkR9is3lYMHjj_X2f44ilX4DKPfHuUqIeoPt1nM-xAD-RTr0o94gg90VS8snkRsahFf4XED83EFqAV6nJVJ4DWUVq-k2kJrbj0qARIfKO1Qt9qiDcWLUQ3CnbuT2XoYuSAPWgsOGucU719UOwr9Qb-gxNGw5fKSN47otnp04bMgLw-6UlPt_8WrHqk3Cz4n-lnKFET0Jrpp7BGtkx7BVNQQRta333v5soUqXHuDhXVUlJEx4WFK3QTnGwguM" />
            </div>
            <div
                class="max-w-7xl mx-auto px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 bg-secondary-fixed text-on-secondary-fixed rounded-full font-label-sm text-label-sm">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Sistem Informasi Layanan Publik Terpadu
                    </div>
                    <h1 class="font-headline-xl text-headline-xl text-primary leading-tight">
                        SiAju SKPP, <br />
                        <span class="text-secondary">Pengajuan Berkas</span> <br />
                        Secara Online
                    </h1>
                    <p class="text-body-lg font-body-lg text-on-surface-variant max-w-lg">
                        Layanan Digital Pengajuan dan Penerbitan Surat Keterangan Penghentian Pembayaran (SKPP) ASN
                        Pemko Banjarmasin
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <button
                            class="px-8 py-4 bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center gap-2 shadow-lg hover:shadow-xl transition-all">
                            Mulai Pengajuan
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        <button
                            class="px-8 py-4 border-2 border-primary text-primary rounded-lg font-label-md text-label-md hover:bg-primary/5 transition-colors">
                            Lihat Status Berkas
                        </button>
                    </div>
                    <div class="flex items-center gap-6 pt-6 border-t border-outline-variant">
                        <div class="flex -space-x-3">
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-surface-container flex items-center justify-center overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="A close-up professional portrait of a smiling Indonesian female administrative official in a neat uniform, soft corporate office lighting, high-quality photography."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxtBoMNLPhyzDvCHEXbykq57skVfjhVFe3VFo5RPh83XO3Oq5cMWH7kic_RqdHzEtMt8yJudFBo6MQBdYsLMTz4tHPZam6nvcqdVDlpl5FPQRTlabrc9bft9Me2wvtLjW4B8_Q6iUI81FTuAl4ob30utiPBcuuO_hI_lycBGmP8Bd8Ompp1BPJ3wTiJGICsLIp-wBH5DHLUfFLvb8wDb2iGlITf5Es36czIm6LWL7rp14XDLk_dkGiE2X43c34KhYtd0ApMq5ReEA" />
                            </div>
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-surface-container flex items-center justify-center overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="A professional portrait of an Indonesian male government worker with a friendly expression, modern office setting background, bright natural lighting."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7YELkXJlhIsc5qEzZbCLRWIJr0u3DSyIZKttQhtLhava5_xhUL4cldIXd5YOLBLejpCeVXOAKfEmVIVZK_2E7chY2-KqIe6UNwXKm-nQsiWvbH-Dy3wVHCeQ6AlRiPD5UFF9rTv1q8Oeq_Gn43NWMKY9eDbrXVwcd4eviaslEJBgvcA7SC-Im4gRt8Y1a76b1LUB-B0TLuT9P_8htSQFthMAQLXY7654sl49VrTLzgh_u-EhEExcBD2NOLI0t4t8s4aqQipQlo0s" />
                            </div>
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-primary flex items-center justify-center">
                                <span class="text-[10px] text-white font-bold">+5k</span>
                            </div>
                        </div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant">
                           Layanan Mandiri Pengajuan SKPP secara online
                        </p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="relative">
                        <div class="absolute -top-12 -left-12 w-64 h-64 bg-secondary-fixed/30 rounded-full blur-3xl">
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-2xl relative border border-outline-variant">
                            <img class="w-full h-auto rounded-lg"
                                data-alt="A high-quality 3D digital render of a sleek, modern tablet displaying a clean government dashboard interface with charts and document icons. The color palette features deep forest green and gold accents against a clean white background, conveying trust and professional administrative excellence."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA69RfmnL1dlryP3Wc5oKTthJVCHT1cQTrFYYjFtYEqW5dzLdJfr5agsJwyIPEE152XrjlHu8avYQxxWse3grN37uzFJmzZTp6QaDPymCmV3C5PMrY0gB3adOfV0sI1hgEBZp0owcLSfQaeGfKcthaJDY_kzw4Dy9lqbCfhViS7Sql5bGGEqpilRNHKi9NpuLwb6_80_PgRl5OFgkFuW33xrLDObObSJYC-WnYBf67dtxeHKgMcvCV3sd9hMjtfHOw3ijRvXo0aYNY" />
                            <div
                                class="absolute -bottom-6 -right-6 bg-primary-container p-6 rounded-xl shadow-xl text-white max-w-[200px]">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-symbols-outlined text-secondary-fixed">timer</span>
                                    <span class="font-bold">Proses Cepat</span>
                                </div>
                                <p class="text-[12px] opacity-80 leading-snug">proses cepat, efektif dan paperless</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- Footer -->
    <footer class="bg-primary dark:bg-tertiary">
        <div
            class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-12 w-full max-w-7xl mx-auto">
            <div class="mb-8 md:mb-0 space-y-4">
                <div class="flex items-center gap-3">
                    <img alt="SiAju SKPP Logo White" class="h-12 w-auto invert brightness-0 grayscale"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuATm778DoYQoQI0DRrQkR9is3lYMHjj_X2f44ilX4DKPfHuUqIeoPt1nM-xAD-RTr0o94gg90VS8snkRsahFf4XED83EFqAV6nJVJ4DWUVq-k2kJrbj0qARIfKO1Qt9qiDcWLUQ3CnbuT2XoYuSAPWgsOGucU719UOwr9Qb-gxNGw5fKSN47otnp04bMgLw-6UlPt_8WrHqk3Cz4n-lnKFET0Jrpp7BGtkx7BVNQQRta333v5soUqXHuDhXVUlJEx4WFK3QTnGwguM" />
                    <span
                        class="font-headline-md text-headline-md text-secondary-fixed dark:text-secondary-fixed-dim">SiAju
                        SKPP</span>
                </div>
                <p class="text-on-primary-container max-w-xs font-body-sm text-body-sm">Sistem Informasi Pengajuan
                    Berkas Digital untuk pelayanan publik yang lebih cepat dan efisien.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-8 md:gap-12 mb-8 md:mb-0">
                <div class="space-y-4">
                    <p class="text-white font-bold font-label-md text-label-md">Tautan Cepat</p>
                    <div class="flex flex-col gap-2">
                        <a class="text-on-primary-container dark:text-on-tertiary-container hover:text-white transition-colors font-body-sm text-body-sm"
                            href="#">Kebijakan Privasi</a>
                        <a class="text-on-primary-container dark:text-on-tertiary-container hover:text-white transition-colors font-body-sm text-body-sm"
                            href="#">Syarat & Ketentuan</a>
                        <a class="text-on-primary-container dark:text-on-tertiary-container hover:text-white transition-colors font-body-sm text-body-sm"
                            href="#">Kontak Kami</a>
                        <a class="text-on-primary-container dark:text-on-tertiary-container hover:text-white transition-colors font-body-sm text-body-sm"
                            href="#">Bantuan</a>
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="text-white font-bold font-label-md text-label-md">Sosial Media</p>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-secondary transition-colors text-white"
                            href="#">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                                </path>
                            </svg>
                        </a>
                        <a class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-secondary transition-colors text-white"
                            href="#">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border-t border-white/10 py-6">
            <div class="max-w-7xl mx-auto px-margin-desktop text-center">
                <p class="text-on-primary-container font-body-sm text-body-sm">© 2024 SiAju SKPP. Hak Cipta Dilindungi
                    Undang-Undang.</p>
            </div>
        </div>
    </footer>
    <script>
        // Micro-interactions and effects
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Sticky Navbar subtle shadow on scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-md');
                nav.classList.remove('border-b');
            } else {
                nav.classList.remove('shadow-md');
                nav.classList.add('border-b');
            }
        });
    </script>
</body>

</html>