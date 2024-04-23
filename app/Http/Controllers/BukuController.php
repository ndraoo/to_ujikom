<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kategoribuku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $view = 'admin.buku.index';
        } elseif ($user->level == 'petugas') {
            $view = 'petugas.buku.index';
        }
        $buku = buku::latest()->paginate(10);

        $title = 'Hapus buku!';
        $text = "Apakah kamu yakin ingin menghapusnya?";
        confirmDelete($title, $text);

        return view($view, compact('buku'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()->level == 'admin') {
            $view = 'admin.buku.create';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.buku.create';
        }
        $kategori = kategoribuku::all();
        return view($view, compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:100',
            'penulis' => 'required|max:100',
            'penerbit' => 'required|max:50',
            'tahun_terbit' => 'required|max:50',
            'deskripsi' => 'required|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
            'kategori' => 'required|array',
        ]);

        $fotoPath = $request->file('foto')->store('buku_foto', 'public');

        $book = buku::create([
            'judul' => $validatedData['judul'],
            'penulis' => $validatedData['penulis'],
            'penerbit' => $validatedData['penerbit'],
            'tahun_terbit' => $validatedData['tahun_terbit'],
            'deskripsi' => $validatedData['deskripsi'],
            'foto' => $fotoPath,
        ]);

        $selectedCategories = $validatedData['kategori'];
        $currentCategories = $book->kategoribuku->pluck('id')->toArray();

        $newCategories = array_diff($selectedCategories, $currentCategories);
        $book->kategoribuku()->attach($newCategories);

        if (Auth::user()->level == 'admin') {
            $view = 'admin.buku.index';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.buku.index';
        }
        return redirect()->route($view)->with('success', 'buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user()->level == 'admin') {
            $view = 'admin.buku.edit';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.buku.edit';
        }

        $buku = buku::findOrFail($id);
        return view($view, compact('buku'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:100',
            'penulis' => 'required|max:100',
            'penerbit' => 'required|max:50',
            'tahun_terbit' => 'required|max:50',
            'deskripsi' => 'required|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buku = buku::findOrFail($id);

        // Jika ada foto yang diunggah, lakukan update
        if ($request->hasFile('foto')) {
            // Upload foto baru
            $fotoPath = $request->file('foto')->store('buku_foto', 'public');

            // Hapus foto lama (jika ada)
            Storage::disk('public')->delete($buku->foto);

            // Update data buku beserta foto
            $buku->update([
                'judul' => $validatedData['judul'],
                'penulis' => $validatedData['penulis'],
                'penerbit' => $validatedData['penerbit'],
                'tahun_terbit' => $validatedData['tahun_terbit'],
                'deskripsi' => $validatedData['deskripsi'],
                'foto' => $fotoPath,
            ]);
        } else {
            // Update data buku tanpa mengganti foto
            $buku->update($validatedData);
        }
        if (Auth::user()->level == 'admin') {
            $view = 'admin.buku.index';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.buku.index';
        }
        return redirect()->route($view)->with('success', 'buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = buku::find($id);
        $buku->delete();
        if (Auth::user()->level == 'admin') {
            $view = 'admin.buku.index';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.buku.index';
        }
        return redirect()->route($view)->with('success', 'buku berhasil dihapus.');
    }
}
