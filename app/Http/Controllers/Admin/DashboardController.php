<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request)
    {
        // Query untuk pengajuan dengan filter dan sorting
        $query = Pengajuan::with(['user', 'layanan'])
            ->orderBy('created_at', 'desc');

        // Filter search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_pengajuan', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                    })
                    ->orWhereHas('layanan', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $pengajuans = $query->paginate($perPage)->withQueryString();

        // Statistik
        $stats = [
            'total' => Pengajuan::count(),
            'bulan_ini' => Pengajuan::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'menunggu' => Pengajuan::whereIn('status', ['dikirim', 'verifikasi'])->count(),
            'diproses' => Pengajuan::where('status', 'diproses')->count(),
            'selesai' => Pengajuan::where('status', 'selesai')->count(),
            'revisi' => Pengajuan::where('status', 'revisi')->count(),
        ];

        // Pengajuan terbaru untuk quick stats
        $recentPengajuans = Pengajuan::with(['user', 'layanan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('pengajuans', 'stats', 'recentPengajuans'));
    }
}
