<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\PengajuanFile;
use App\Models\PengajuanHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    /**
     * Display the create pengajuan form
     */
    public function create()
    {
        $layanans = Layanan::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('user.pengajuan.create', compact('layanans'));
    }

    /**
     * Store a new pengajuan
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanan,id',
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Generate nomor pengajuan
        $tanggal = Carbon::now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        $nomorPengajuan = "PNG-{$tanggal}-{$random}";

        // Create pengajuan with draft status
        $pengajuan = Pengajuan::create([
            'nomor_pengajuan' => $nomorPengajuan,
            'user_id' => auth()->id(),
            'layanan_id' => $request->layanan_id,
            'tanggal_pengajuan' => Carbon::now(),
            'status' => Pengajuan::STATUS_DRAFT,
            'catatan_user' => $request->catatan,
        ]);

        // Save to pengajuan_history
        PengajuanHistory::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => Pengajuan::STATUS_DRAFT,
            'judul' => 'Pengajuan Dibuat',
            'keterangan' => 'Pengajuan baru berhasil dibuat. Mohon lengkapi dokumen persyaratan.',
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Pengajuan berhasil dibuat. Silakan lengkapi dokumen persyaratan.');
    }

    /**
     * Display the upload form for pengajuan requirements
     */
    public function upload(Pengajuan $pengajuan)
    {
        // Authorization: Check if user owns this pengajuan
        if ($pengajuan->user_id !== auth()->id()) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        // Get the requirements for this layanan
        $persyaratans = $pengajuan->layanan->persyaratans ?? collect();

        // Get existing uploaded files for this pengajuan
        $uploadedFiles = $pengajuan->files()->with('persyaratan')->get()->groupBy('persyaratan_id');

        return view('user.pengajuan.upload', compact('pengajuan', 'persyaratans', 'uploadedFiles'));
    }

    /**
     * Handle the upload of pengajuan requirements
     */
    public function uploadStore(Request $request, Pengajuan $pengajuan)
    {
        // Authorization: Check if user owns this pengajuan
        if ($pengajuan->user_id !== auth()->id()) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        $request->validate([
            'files.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            'persyaratan_id.*' => 'required_with:files.*|exists:persyaratan,id',
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
            ->route('user.pengajuan.show', $pengajuan)
            ->with('success', 'File persyaratan berhasil diupload.');
    }

    /**
     * Display the details of a pengajuan
     */
    public function show($id)
    {
        $pengajuan = Pengajuan::with(['layanan', 'files.persyaratan', 'histories.user'])->findOrFail($id);

        // Authorization: Check if user owns this pengajuan
        if ($pengajuan->user_id !== auth()->id()) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        // Get requirements for this layanan
        $persyaratans = $pengajuan->layanan->persyaratans ?? collect();

        // Group uploaded files by persyaratan
        $uploadedFiles = $pengajuan->files->groupBy('persyaratan_id');

        // Get histories sorted by creation date
        $histories = $pengajuan->histories()->with('user')->orderBy('created_at', 'desc')->get();

        return view('user.pengajuan.show', compact(
            'pengajuan',
            'persyaratans',
            'uploadedFiles',
            'histories'
        ));
    }

    /**
     * Send/Kirim pengajuan
     */
    public function kirim(Pengajuan $pengajuan)
    {
        // Authorization: Check if user owns this pengajuan
        if ($pengajuan->user_id !== auth()->id()) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        // Validate that pengajuan can be sent
        if (!in_array($pengajuan->status, [Pengajuan::STATUS_DRAFT, Pengajuan::STATUS_REVISI])) {
            return redirect()
                ->route('user.pengajuan.show', $pengajuan)
                ->with('error', 'Pengajuan tidak dapat dikirim.');
        }

        // Check if all requirements are uploaded
        $persyaratans = $pengajuan->layanan->persyaratans ?? collect();
        $uploadedCount = $pengajuan->files()->count();
        
        if ($uploadedCount < $persyaratans->count()) {
            return redirect()
                ->route('user.pengajuan.show', $pengajuan)
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
            'judul' => 'Pengajuan Dikirim',
            'keterangan' => 'Pengajuan berhasil dikirim dan sedang menunggu verifikasi dari admin.',
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('user.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil dikirim! Mohon tunggu verifikasi dari admin.');
    }

    /**
     * Delete pengajuan (only if status is draft)
     */
    public function destroy($id)
    {
        // Find pengajuan by ID
        $pengajuan = Pengajuan::find($id);
        
        if (!$pengajuan) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Pengajuan tidak ditemukan.');
        }
        
        // Check if user owns this pengajuan
        if ($pengajuan->user_id !== auth()->id()) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus pengajuan ini.');
        }

        // Only allow deletion if status is draft
        if ($pengajuan->status !== Pengajuan::STATUS_DRAFT) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Pengajuan hanya dapat dihapus jika statusnya draft.');
        }

        // Delete associated files from storage
        foreach ($pengajuan->files as $file) {
            if ($file->file && Storage::disk('public')->exists($file->file)) {
                Storage::disk('public')->delete($file->file);
            }
        }
        
        // Delete related records manually
        $pengajuan->files()->delete();
        $pengajuan->histories()->delete();
        $pengajuan->revisions()->delete();

        // Delete the pengajuan
        $pengajuan->delete();

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
