<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index ()
     {
        return view('sidebar');
    }
    public function show()
    {
        // Logika untuk menampilkan data dengan ID tertentu
    }

}
