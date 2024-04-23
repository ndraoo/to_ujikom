<?php

namespace App\Http\Controllers;
use App\Models\buku;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = buku::latest()->paginate(10);

        $existingPeminjaman = Peminjaman::where('id_user', auth()->user()->id)
        ->where('status_peminjaman', 'dipinjam')
        ->pluck('id_buku')
        ->toArray();

        return view('user.index', compact('buku', 'existingPeminjaman'));
    }
    public function koleksi()
    {
        $id_user = Auth::id();
        // Ambil semua peminjaman berdasarkan id_user yang sedang login
        $peminjaman = Peminjaman::with('buku')->where('id_user', $id_user)->get();

        return view('user.koleksi', compact('peminjaman'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.pengembalian');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
