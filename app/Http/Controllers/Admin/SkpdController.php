<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Skpd::with('user');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_skpd', 'like', "%{$search}%")
                  ->orWhere('nama_skpd', 'like', "%{$search}%");
            });
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Pagination
        $skpd = $query->paginate(10)->withQueryString();

        return view('admin.skpd.index', compact('skpd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skpd.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_skpd' => 'required|string|max:50|unique:skpd,kode_skpd',
            'nama_skpd' => 'required|string|max:255',
        ], [
            'kode_skpd.required' => 'Kode SKPD wajib diisi.',
            'kode_skpd.unique' => 'Kode SKPD sudah terdaftar.',
            'nama_skpd.required' => 'Nama SKPD wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Skpd::create($request->only(['kode_skpd', 'nama_skpd']));

        return redirect()->route('admin.skpd.index')
            ->with('success', 'Data SKPD berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skpd $skpd)
    {
        return view('admin.skpd.show', compact('skpd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skpd $skpd)
    {
        return view('admin.skpd.edit', compact('skpd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skpd $skpd)
    {
        $validator = Validator::make($request->all(), [
            'kode_skpd' => 'required|string|max:50|unique:skpd,kode_skpd,' . $skpd->id,
            'nama_skpd' => 'required|string|max:255',
        ], [
            'kode_skpd.required' => 'Kode SKPD wajib diisi.',
            'kode_skpd.unique' => 'Kode SKPD sudah terdaftar.',
            'nama_skpd.required' => 'Nama SKPD wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $skpd->update($request->only(['kode_skpd', 'nama_skpd']));

        return redirect()->route('admin.skpd.index')
            ->with('success', 'Data SKPD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpd $skpd)
    {
        $skpd->delete();

        return redirect()->route('admin.skpd.index')
            ->with('success', 'Data SKPD berhasil dihapus.');
    }

    /**
     * Create user account for skpd.
     */
    public function createUser(Skpd $skpd)
    {
        // Check if user already exists
        if ($skpd->user_id) {
            return redirect()->route('admin.skpd.index')
                ->with('error', 'SKPD ini sudah memiliki akun user.');
        }

        // Check if username (kode_skpd) already exists
        $existingUser = User::where('username', $skpd->kode_skpd)->first();
        if ($existingUser) {
            return redirect()->route('admin.skpd.index')
                ->with('error', 'Username dengan Kode SKPD ini sudah terdaftar.');
        }

        // Create user with kode_skpd as username
        $user = User::create([
            'name' => $skpd->nama_skpd,
            'username' => $skpd->kode_skpd,
            'email' => $skpd->kode_skpd . '@siajuskpp.local',
            'password' => Hash::make('siajuskppbjm'),
            'role' => 'skpd',
        ]);

        // Link user to skpd
        $skpd->update(['user_id' => $user->id]);

        return redirect()->route('admin.skpd.index')
            ->with('success', 'User account berhasil dibuat untuk ' . $skpd->nama_skpd . '. Username: ' . $skpd->kode_skpd . ', Password: siajuskppbjm');
    }

    /**
     * Reset password user account.
     */
    public function resetPassword(Skpd $skpd)
    {
        // Check if user exists
        if (!$skpd->user_id || !$skpd->user) {
            return redirect()->route('admin.skpd.index')
                ->with('error', 'SKPD ini belum memiliki akun user.');
        }

        // Reset password
        $skpd->user->update([
            'password' => Hash::make('siajuskppbjm'),
        ]);

        return redirect()->route('admin.skpd.index')
            ->with('success', 'Password berhasil direset untuk ' . $skpd->nama_skpd . '. Password baru: siajuskppbjm');
    }
}
