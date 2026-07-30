<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with(['user', 'skpd']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhereHas('skpd', function($q) use ($search) {
                      $q->where('nama_skpd', 'like', "%{$search}%");
                  });
            });
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Pagination
        $pegawai = $query->paginate(10)->withQueryString();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skpd = Skpd::orderBy('nama_skpd')->get();
        return view('admin.pegawai.create', compact('skpd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:50|unique:pegawai,nip',
            'nama' => 'required|string|max:255',
            'skpd_id' => 'required|exists:skpd,id',
            'telp' => 'nullable|string|max:20',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'skpd_id.required' => 'SKPD wajib dipilih.',
            'skpd_id.exists' => 'SKPD yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Pegawai::create($request->only(['nip', 'nama', 'skpd_id', 'telp']));

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        return view('admin.pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $skpd = Skpd::orderBy('nama_skpd')->get();
        return view('admin.pegawai.edit', compact('pegawai', 'skpd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:50|unique:pegawai,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'skpd_id' => 'required|exists:skpd,id',
            'telp' => 'nullable|string|max:20',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'skpd_id.required' => 'SKPD wajib dipilih.',
            'skpd_id.exists' => 'SKPD yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pegawai->update($request->only(['nip', 'nama', 'skpd_id', 'telp']));

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }

    /**
     * Create user account for pegawai.
     */
    public function createUser(Pegawai $pegawai)
    {
        // Check if user already exists
        if ($pegawai->user_id) {
            return redirect()->route('admin.pegawai.index')
                ->with('error', 'Pegawai ini sudah memiliki akun user.');
        }

        // Check if username (nip) already exists
        $existingUser = User::where('username', $pegawai->nip)->first();
        if ($existingUser) {
            return redirect()->route('admin.pegawai.index')
                ->with('error', 'Username dengan NIP ini sudah terdaftar.');
        }

        // Create user with NIP as username
        $user = User::create([
            'name' => $pegawai->nama,
            'username' => $pegawai->nip,
            'email' => $pegawai->nip . '@siajuskpp.local',
            'password' => Hash::make('siajuskppbjm'),
            'role' => 'pegawai',
        ]);

        // Link user to pegawai
        $pegawai->update(['user_id' => $user->id]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'User account berhasil dibuat untuk ' . $pegawai->nama . '. Username: ' . $pegawai->nip . ', Password: siajuskppbjm');
    }

    /**
     * Reset password user account.
     */
    public function resetPassword(Pegawai $pegawai)
    {
        // Check if user exists
        if (!$pegawai->user_id || !$pegawai->user) {
            return redirect()->route('admin.pegawai.index')
                ->with('error', 'Pegawai ini belum memiliki akun user.');
        }

        // Reset password
        $pegawai->user->update([
            'password' => Hash::make('siajuskppbjm'),
        ]);

        return redirect()->route('admin.pegawai.index')
            ->with('success', 'Password berhasil direset untuk ' . $pegawai->nama . '. Password baru: siajuskppbjm');
    }
}
