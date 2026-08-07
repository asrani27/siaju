<?php

namespace App\Http\Controllers\SKPD;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\PengajuanFile;
use App\Models\PengajuanHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    /**
     * Display the create pengajuan form
     */
    public function create()
    {
        $user = auth()->user();
        
        // Get the SKPD associated with this user
        $skpd = \App\Models\Skpd::where('user_id', $user->id)->first();
        
        if (!$skpd) {
            return redirect()->route('skpd.dashboard')->with('error', 'SKPD tidak ditemukan');
        }
        
        // Get all services (layanan)
        $layanans = Layanan::where('is_active', true)
            ->orderBy('nama')
            ->get();
        
        // Get all employees (pegawai) in this SKPD who have user accounts
        $pegawais = Pegawai::with('user')
            ->where('skpd_id', $skpd->id)
            ->whereNotNull('user_id')
            ->orderBy('nama')
            ->get();
        
        return view('skpd.pengajuan.create', compact('layanans', 'pegawais', 'skpd'));
    }

    /**
     * Store a new pengajuan for a selected employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'layanan_id' => 'required|exists:layanan,id',
            'catatan' => 'nullable|string|max:1000',
        ]);
        
        $user = auth()->user();
        
        // Get the SKPD associated with this user
        $skpd = \App\Models\Skpd::where('user_id', $user->id)->first();
        
        if (!$skpd) {
            return redirect()->route('skpd.dashboard')->with('error', 'SKPD tidak ditemukan');
        }
        
        // Get the selected pegawai
        $pegawai = Pegawai::where('id', $request->pegawai_id)
            ->where('skpd_id', $skpd->id)
            ->first();
        
        if (!$pegawai) {
            return redirect()->route('skpd.dashboard')->with('error', 'Pegawai tidak ditemukan dalam SKPD ini');
        }
        
        if (!$pegawai->user_id) {
            return redirect()->route('skpd.pengajuan.create')->with('error', 'Pegawai tidak memiliki akun pengguna');
        }
        
        // Generate nomor pengajuan
        $tanggal = Carbon::now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        $nomorPengajuan = "PNG-{$tanggal}-{$random}";

        // Create pengajuan with draft status
        $pengajuan = Pengajuan::create([
            'nomor_pengajuan' => $nomorPengajuan,
            'user_id' => $pegawai->user_id,
            'layanan_id' => $request->layanan_id,
            'skpd_id' => $skpd->id,
            'tanggal_pengajuan' => Carbon::now(),
            'status' => Pengajuan::STATUS_DRAFT,
            'catatan_user' => $request->catatan,
        ]);

        // Save to pengajuan_history
        PengajuanHistory::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => Pengajuan::STATUS_DRAFT,
            'judul' => 'Pengajuan Dibuat oleh Admin SKPD',
            'keterangan' => 'Pengajuan baru berhasil dibuat oleh Admin SKPD untuk ' . $pegawai->nama . '. Mohon lengkapi dokumen persyaratan.',
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('skpd.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil dibuat untuk ' . $pegawai->nama . '. Mohon lengkapi dokumen persyaratan.');
    }

    /**
     * Handle the upload of pengajuan requirements
     */
    public function uploadStore(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'files.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'files.*.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
            'files.*.max' => 'Ukuran file maksimal 5MB',
        ]);

        // Handle file uploads for each persyaratan
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $persyaratanId => $file) {
                if ($file && $persyaratanId) {
                    // Delete existing files for this persyaratan (replace behavior)
                    $existingFiles = PengajuanFile::where('pengajuan_id', $pengajuan->id)
                        ->where('persyaratan_id', $persyaratanId)
                        ->get();
                    
                    foreach ($existingFiles as $existingFile) {
                        // Delete physical file
                        if ($existingFile->file && Storage::disk('public')->exists($existingFile->file)) {
                            Storage::disk('public')->delete($existingFile->file);
                        }
                        // Delete database record
                        $existingFile->delete();
                    }
                    
                    // Create new file record
                    $filename = time() . '_' . $persyaratanId . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('pengajuan_files', $filename, 'public');

                    PengajuanFile::create([
                        'pengajuan_id' => $pengajuan->id,
                        'persyaratan_id' => $persyaratanId,
                        'nama_file' => $file->getClientOriginalName(),
                        'file' => $path,
                        'mime' => $file->getClientMimeType(),
                        'ukuran' => $file->getSize(),
                        'status' => 'menunggu',
                        'uploaded_at' => now(),
                    ]);
                }
            }
        }

        return redirect()
            ->route('skpd.pengajuan.show', $pengajuan)
            ->with('success', 'File persyaratan berhasil diupload.');
    }

    /**
     * Send/Kirim pengajuan
     */
    public function kirim(Pengajuan $pengajuan)
    {
        // Get the SKPD associated with the current user
        $user = auth()->user();
        $skpd = \App\Models\Skpd::where('user_id', $user->id)->first();
        
        // Check if pengajuan belongs to this SKPD
        if ($pengajuan->skpd_id !== $skpd->id) {
            return redirect()
                ->route('skpd.pengajuan.index')
                ->with('error', 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        // Validate that pengajuan can be sent
        if (!in_array($pengajuan->status, [Pengajuan::STATUS_DRAFT, Pengajuan::STATUS_REVISI])) {
            return redirect()
                ->route('skpd.pengajuan.show', $pengajuan)
                ->with('error', 'Pengajuan tidak dapat dikirim.');
        }

        // Check if all requirements are uploaded
        $persyaratans = $pengajuan->layanan->persyaratans ?? collect();
        $uploadedCount = $pengajuan->files()->count();
        
        if ($uploadedCount < $persyaratans->count()) {
            return redirect()
                ->route('skpd.pengajuan.show', $pengajuan)
                ->with('error', 'Mohon upload semua dokumen persyaratan sebelum mengirim pengajuan.');
        }

        // Update status to 'dikirim'
        $pengajuan->update([
            'status' => Pengajuan::STATUS_DIKIRIM,
        ]);

        // Save to pengajuan_history
        PengajuanHistory::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => Pengajuan::STATUS_DIKIRIM,
            'judul' => 'Pengajuan Dikirim oleh Admin SKPD',
            'keterangan' => 'Pengajuan berhasil dikirim dan sedang menunggu verifikasi dari admin.',
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('skpd.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil dikirim! Mohon tunggu verifikasi dari admin.');
    }
}
