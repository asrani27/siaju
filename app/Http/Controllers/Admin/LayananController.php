<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Layanan::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Pagination
        $layanan = $query->paginate(10)->withQueryString();

        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:50|unique:layanan,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ], [
            'kode.required' => 'Kode layanan wajib diisi.',
            'kode.unique' => 'Kode layanan sudah terdaftar.',
            'nama.required' => 'Nama layanan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['kode', 'nama', 'deskripsi']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Data layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        // Load relationships
        $layanan->load(['persyaratans', 'pengajuans']);

        return view('admin.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:50|unique:layanan,kode,' . $layanan->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ], [
            'kode.required' => 'Kode layanan wajib diisi.',
            'kode.unique' => 'Kode layanan sudah terdaftar.',
            'nama.required' => 'Nama layanan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['kode', 'nama', 'deskripsi']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Data layanan berhasil dihapus.');
    }

    /**
     * Toggle status of the layanan.
     */
    public function toggleStatus(Layanan $layanan)
    {
        $layanan->update(['is_active' => !$layanan->is_active]);

        $status = $layanan->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.layanan.index')
            ->with('success', "Layanan berhasil {$status}.");
    }
}
