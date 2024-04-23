<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\buku;
use App\Models\peminjaman;
use App\Models\ulasanbuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function indexPeminjaman()
    {
        $peminjaman = peminjaman::with('buku', 'user')->latest()->paginate(10);
        if (Auth::user()->level == 'admin') {
            $view = 'admin.peminjaman.index';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.peminjaman.index';
        }

        return view($view, compact('peminjaman'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status_peminjaman = $request->status;
        $peminjaman->save();
        if (Auth::user()->level == 'admin') {
            $view = 'admin.peminjaman.index';
        } elseif (Auth::user()->level == 'petugas') {
            $view = 'petugas.peminjaman.index';
        }
        return redirect()->route($view)
                         ->with('success', 'Status peminjaman berhasil diperbarui.');
    }

     public function showForm($id)
    {
        $buku = buku::findOrFail($id);
        return view('user.peminjaman', compact('buku'));
    }

    public function pinjamBuku(Request $request)
    {
        $validatedData = $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ]);

        $existingPeminjaman = Peminjaman::where('id_user', auth()->user()->id)
                                        ->where('id_buku', $validatedData['id_buku'])
                                        ->where('status_peminjaman', 'dipinjam')
                                        ->exists();

        if ($existingPeminjaman) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini sebelumnya.');
        }

        Peminjaman::create([
            'id_user' => auth()->user()->id,
            'id_buku' => $validatedData['id_buku'],
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => $validatedData['tanggal_pengembalian'],
            'status_peminjaman' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku = Buku::findOrFail($validatedData['id_buku']);
        $buku->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->intended('user')->with('success', 'Buku berhasil dipinjam.');
    }

    public function pengembalianIndex()
    {
        $peminjaman = Peminjaman::with('buku')
        ->where('id_user', auth()->user()->id)
        ->where('status_peminjaman', 'dipinjam')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('user.pengembalian', compact('peminjaman'));
    }

    public function formPengembalian($id)
    {
        $peminjaman = peminjaman::findOrFail($id);
        return view('user.formPengembalian', compact('peminjaman'));
    }

    public function updatePengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Perbarui status peminjaman menjadi 'dikembalikan'
        $peminjaman->update([
            'status_peminjaman' => 'kembali',
        ]);

        return redirect()->route('user.pengembalian.form')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function kembalikanBuku(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|exists:bukus,judul', // Pastikan buku yang akan dikembalikan sudah pernah dipinjam
        ]);

        // Cari peminjaman berdasarkan judul buku dan id user yang sedang login
        $peminjaman = Peminjaman::whereHas('buku', function($query) use ($validatedData) {
                $query->where('judul', $validatedData['judul']);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status_peminjaman', 'dipinjam')
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Buku tidak dapat ditemukan atau buku tersebut tidak sedang dipinjam.');
        }

        // Ubah status peminjaman menjadi 'kembali'
        $peminjaman->update([
            'status_peminjaman' => 'kembali',
        ]);

        return redirect()->route('user.index')->with('success', 'Buku berhasil dikembalikan.');
    }

     public function ulasanCreate($id)
    {
        $buku = buku::findOrFail($id);
        $ulasan = UlasanBuku::with('user')
                    ->where('id_buku', $id)
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(3);

        return view('user.ulasan', compact('buku', 'ulasan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeUlasan(Request $request)
    {
        $validatedData = $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Simpan ulasan ke dalam database
        ulasanbuku::create([
            'id_user' => auth()->user()->id,
            'id_buku' => $validatedData['id_buku'],
            'ulasan' => $validatedData['ulasan'],
            'rating' => $validatedData['rating'],
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil.');
    }

    public function generatePDF(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'))->startOfWeek()->format('Y-m-d');
        $endDate = Carbon::parse($request->input('end_date'))->endOfWeek()->format('Y-m-d');

        $peminjaman = Peminjaman::with('buku', 'user')
                    ->whereBetween('created_at', [$startDate, $endDate])
                        ->latest()
                        ->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.laporan.index', compact('peminjaman'))->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('laporan_peminjaman.pdf');
    }
}
