<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display user dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get statistics
        $stats = [
            'total' => Pengajuan::where('user_id', $user->id)->count(),
            'dalam_proses' => Pengajuan::where('user_id', $user->id)
                ->whereIn('status', ['dikirim', 'verifikasi', 'diproses'])
                ->count(),
            'selesai' => Pengajuan::where('user_id', $user->id)
                ->where('status', 'selesai')
                ->whereMonth('tanggal_selesai', Carbon::now()->month)
                ->count(),
            'perlu_revisi' => Pengajuan::where('user_id', $user->id)
                ->where('status', 'revisi')
                ->count(),
        ];
        
        // Get recent pengajuan (latest 5)
        $recentPengajuan = Pengajuan::with('layanan')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Count notifications (pengajuan needing attention)
        $notificationCount = Pengajuan::where('user_id', $user->id)
            ->whereIn('status', ['revisi', 'verifikasi'])
            ->count();
        
        return view('user.dashboard', compact(
            'stats',
            'recentPengajuan',
            'notificationCount'
        ));
    }
}
