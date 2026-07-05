<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of pengajuan.
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'layanan'])
            ->orderBy('created_at', 'desc');

        // Filter by search
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

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by layanan
        if ($request->has('layanan_id') && $request->layanan_id) {
            $query->where('layanan_id', $request->layanan_id);
        }

        // Filter by date range
        if ($request->has('tanggal_dari') && $request->tanggal_dari) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai') && $request->tanggal_sampai) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->tanggal_sampai);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $pengajuans = $query->paginate($perPage)->withQueryString();

        // Stats for sidebar
        $stats = [
            'total' => Pengajuan::count(),
            'menunggu' => Pengajuan::whereIn('status', ['dikirim', 'verifikasi'])->count(),
            'diproses' => Pengajuan::where('status', 'diproses')->count(),
            'selesai' => Pengajuan::where('status', 'selesai')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
            'revisi' => Pengajuan::where('status', 'revisi')->count(),
        ];

        return view('admin.pengajuan.index', compact('pengajuans', 'stats'));
    }

    /**
     * Display the specified pengajuan.
     */
    public function show($id)
    {
        $pengajuan = Pengajuan::with([
            'user',
            'layanan',
            'files.persyaratan',
            'histories.user',
            'revisions'
        ])->findOrFail($id);

        // Get requirements for this layanan
        $persyaratans = $pengajuan->layanan->persyaratans ?? collect();

        // Group uploaded files by persyaratan
        $uploadedFiles = $pengajuan->files->groupBy('persyaratan_id');

        // Get histories sorted by creation date
        $histories = $pengajuan->histories()->with('user')->orderBy('created_at', 'desc')->get();

        // Get revisions
        $revisions = $pengajuan->revisions()->orderBy('created_at', 'desc')->get();

        return view('admin.pengajuan.show', compact(
            'pengajuan',
            'persyaratans',
            'uploadedFiles',
            'histories',
            'revisions'
        ));
    }

    /**
     * Update the status of a pengajuan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dikirim,verifikasi,diproses,revisi,selesai,ditolak,dibatalkan',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $oldStatus = $pengajuan->status;
        $newStatus = $request->status;

        // Update status
        $pengajuan->status = $newStatus;

        // Set tanggal_selesai if status is selesai
        if ($newStatus === 'selesai' && !$pengajuan->tanggal_selesai) {
            $pengajuan->tanggal_selesai = now();
        }

        $pengajuan->save();

        // Create history record
        $pengajuan->histories()->create([
            'user_id' => Auth::id(),
            'status_lama' => $oldStatus,
            'status_baru' => $newStatus,
            'catatan' => $request->catatan,
            'tanggal_status' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    /**
     * Send pengajuan back for revision.
     */
    public function requestRevision(Request $request, $id)
    {
        $request->validate([
            'catatan_revisi' => 'required|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $oldStatus = $pengajuan->status;

        // Update status to revision
        $pengajuan->status = 'revisi';
        $pengajuan->save();

        // Create history record
        $pengajuan->histories()->create([
            'user_id' => Auth::id(),
            'status_lama' => $oldStatus,
            'status_baru' => 'revisi',
            'catatan' => $request->catatan_revisi,
            'tanggal_status' => now(),
        ]);

        // Create revision record
        $pengajuan->revisions()->create([
            'pengajuan_id' => $pengajuan->id,
            'catatan' => $request->catatan_revisi,
            'tanggal_revisi' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan dikembalikan untuk direvisi.');
    }

    /**
     * Process verification action (approve, revision, or reject).
     */
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:disetujui',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $oldStatus = $pengajuan->status;

        // Update status to selesai (disetujui)
        $pengajuan->status = 'selesai';
        $pengajuan->tanggal_selesai = now();
        $pengajuan->save();

        // Create history record
        $pengajuan->histories()->create([
            'user_id' => Auth::id(),
            'status_lama' => $oldStatus,
            'status_baru' => 'selesai',
            'catatan' => $request->catatan ?? 'Pengajuan disetujui.',
            'tanggal_status' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    /**
     * Send pengajuan for revision with detailed notes.
     */
    public function revisi(Request $request, $id)
    {
        $request->validate([
            'catatan_revisi' => 'required|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $oldStatus = $pengajuan->status;

        // Update status to revision
        $pengajuan->status = 'revisi';
        $pengajuan->save();

        // Create history record
        $pengajuan->histories()->create([
            'user_id' => Auth::id(),
            'status_lama' => $oldStatus,
            'status_baru' => 'revisi',
            'catatan' => $request->catatan_revisi,
            'tanggal_status' => now(),
        ]);

        // Create revision record
        $pengajuan->revisions()->create([
            'pengajuan_id' => $pengajuan->id,
            'catatan' => $request->catatan_revisi,
            'tanggal_revisi' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan dikembalikan untuk direvisi.');
    }

    /**
     * Reject pengajuan.
     */
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_penolakan' => 'required|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $oldStatus = $pengajuan->status;

        // Update status to ditolak
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        // Create history record
        $pengajuan->histories()->create([
            'user_id' => Auth::id(),
            'status_lama' => $oldStatus,
            'status_baru' => 'ditolak',
            'catatan' => $request->catatan_penolakan,
            'tanggal_status' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
