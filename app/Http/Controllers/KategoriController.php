<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\kategoribuku;
class KategoriController extends Controller
{
    public function kategoriBukuIndex()
    {
        $kategori = kategoribuku::latest()->paginate(10);

        $title = 'Hapus Kategori!';
        $text = "Apakah kamu yakin ingin menghapusnya?";
        confirmDelete($title, $text);
        return view('admin.kategori.index', compact('kategori'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function kategoriBukuCreate()
    {
        return view('admin.kategori.create');
    }

    public function kategoriBukuStore(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:100',
        ]);

        kategoribuku::create([
            'nama_kategori' => $validatedData['nama_kategori'],
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori Behasil Ditambahkan');
    }

    public function kategoriBukuEdit($id)
    {
        $kategori = kategoribuku::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function kategoriBukuUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:100',
        ]);

        $kategori = kategoribuku::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $validatedData['nama_kategori'],
        ]);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }
    public function kategoriBukuDestroy($id)
    {
        $kategori = kategoribuku::find($id);

        if (!$kategori) {
            return redirect()->route('admin.kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
