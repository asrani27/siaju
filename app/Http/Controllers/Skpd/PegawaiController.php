<?php

namespace App\Http\Controllers\Skpd;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        if (!$skpd) {
            return redirect()->route('skpd.dashboard')
                ->with('error', 'Data SKPD tidak ditemukan.');
        }

        $query = Pegawai::with(['user'])
            ->where('skpd_id', $skpd->id);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Pagination
        $pegawai = $query->paginate(10)->withQueryString();

        return view('skpd.pegawai.index', compact('pegawai', 'skpd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        return view('skpd.pegawai.create', compact('skpd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nip' => 'required|string|max:50|unique:pegawai,nip',
            'nama' => 'required|string|max:255',
            'telp' => 'nullable|string|max:20',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nip', 'nama', 'telp']);
        $data['skpd_id'] = $skpd->id;
        Pegawai::create($data);

        return redirect()->route('skpd.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        // Ensure pegawai belongs to user's skpd
        if ($pegawai->skpd_id !== $skpd->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('skpd.pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        // Ensure pegawai belongs to user's skpd
        if ($pegawai->skpd_id !== $skpd->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('skpd.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        // Ensure pegawai belongs to user's skpd
        if ($pegawai->skpd_id !== $skpd->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nip' => 'required|string|max:50|unique:pegawai,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'telp' => 'nullable|string|max:20',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pegawai->update($request->only(['nip', 'nama', 'telp']));

        return redirect()->route('skpd.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $user = auth()->user();
        $skpd = $user->skpd;

        // Ensure pegawai belongs to user's skpd
        if ($pegawai->skpd_id !== $skpd->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $pegawai->delete();

        return redirect()->route('skpd.pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}
