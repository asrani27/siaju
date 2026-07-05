<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\PengajuanFile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Pengajuan berhasil dibuat. Silakan lengkapi dokumen persyaratan.');
    }

    /**
     * Display the upload form for pengajuan requirements
     */
    public function upload(Pengajuan $pengajuan)
    {
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
                    $filename = time() . '_' . $persyaratanId . '_' . Str::random(4) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('pengajuan_files', $filename, 'public');
                    
                    // Create new file record
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

        // Update status back to verifikasi
        $pengajuan->update(['status' => Pengajuan::STATUS_VERIFIKASI]);

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
}
