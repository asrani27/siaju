<?php

namespace App\Http\Controllers\Skpd;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Skpd;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display SKPD dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get the SKPD associated with this user
        $skpd = Skpd::where('user_id', $user->id)->first();
        
        if (!$skpd) {
            return redirect()->route('home')->with('error', 'SKPD tidak ditemukan');
        }
        
        // Get statistics based on skpd_id
        $stats = [
            'total' => Pengajuan::where('skpd_id', $skpd->id)->count(),
            'dalam_proses' => Pengajuan::where('skpd_id', $skpd->id)
                ->whereIn('status', ['dikirim', 'verifikasi', 'diproses'])
                ->count(),
            'selesai' => Pengajuan::where('skpd_id', $skpd->id)
                ->where('status', 'selesai')
                ->whereMonth('tanggal_selesai', Carbon::now()->month)
                ->count(),
            'perlu_revisi' => Pengajuan::where('skpd_id', $skpd->id)
                ->where('status', 'revisi')
                ->count(),
        ];
        
        // Get recent pengajuan from all employees in this SKPD (latest 10)
        $recentPengajuan = Pengajuan::with(['layanan', 'user'])
            ->where('skpd_id', $skpd->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Count notifications (pengajuan needing attention)
        $notificationCount = Pengajuan::where('skpd_id', $skpd->id)
            ->whereIn('status', ['revisi', 'verifikasi'])
            ->count();
        
        return view('skpd.dashboard', compact(
            'stats',
            'recentPengajuan',
            'notificationCount',
            'skpd'
        ));
    }
}
