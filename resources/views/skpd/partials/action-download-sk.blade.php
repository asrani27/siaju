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
