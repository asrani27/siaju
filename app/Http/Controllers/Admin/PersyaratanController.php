<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Layanan $layanan)
    {
        $query = $layanan->persyaratans();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        // Filter by required status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_required', $request->status);
        }

        // Order by urutan
        $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');

        // Pagination
        $persyaratans = $query->paginate(10)->withQueryString();

        return view('admin.persyaratan.index', compact('layanan', 'persyaratans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Layanan $layanan)
    {
        return view('admin.persyaratan.create', compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Layanan $layanan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'is_required' => 'nullable|boolean',
            'urutan' => 'nullable|integer|min:1',
        ], [
            'nama.required' => 'Nama persyaratan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nama', 'keterangan']);
        $data['is_required'] = $request->has('is_required') ? 1 : 0;
        $data['urutan'] = $request->urutan ?? 1;
        $data['layanan_id'] = $layanan->id;

        Persyaratan::create($data);

        return redirect()->route('admin.persyaratan.index', $layanan)
            ->with('success', 'Data persyaratan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan, Persyaratan $persyaratan)
    {
        return view('admin.persyaratan.edit', compact('layanan', 'persyaratan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan, Persyaratan $persyaratan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'is_required' => 'nullable|boolean',
            'urutan' => 'nullable|integer|min:1',
        ], [
            'nama.required' => 'Nama persyaratan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nama', 'keterangan']);
        $data['is_required'] = $request->has('is_required') ? 1 : 0;
        $data['urutan'] = $request->urutan ?? 1;

        $persyaratan->update($data);

        return redirect()->route('admin.persyaratan.index', $layanan)
            ->with('success', 'Data persyaratan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan, Persyaratan $persyaratan)
    {
        $persyaratan->delete();

        return redirect()->route('admin.persyaratan.index', $layanan)
            ->with('success', 'Data persyaratan berhasil dihapus.');
    }
}
