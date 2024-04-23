<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 'user') {
                return redirect()->intended('user');
            } elseif ($user->level == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->level == 'petugas') {
                return redirect()->intended('petugas');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('username','password');
        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            if ($user->level == 'user') {
                Alert::success('Login Berhasil', 'Selamat datang!');
                return redirect()->intended('user');
            } elseif ($user->level == 'admin') {
                Alert::success('Login Berhasil', 'Selamat datang, Admin!');
                return redirect()->intended('admin');
            } elseif ($user->level == 'petugas') {
                Alert::success('Login Berhasil', 'Selamat datang, Petugas!');
                return redirect()->intended('petugas');
            }
            return redirect()->intended('/login');
        }
            $errorMessages = [];
            $user = User::where('username', $request->username)->first();

            if (!$user) {
                $errorMessages[] = 'Username tidak ditemukan.';
            } else {
                $errorMessages[] = 'Password salah.';
            }

    return redirect('login')->with('error', $errorMessages);
    }

    public function create()
    {
        return view('login');
    }

    public function store(Request $request) {

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ], [
            'username.required' => 'Username harus diisi.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ]);

            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
            ]);

            Alert::success('Registrasi Berhasil', 'Silahkan login dengan akun Anda.');
            return redirect()->route('login');
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       Alert::success('Logout Berhasil', 'Anda telah berhasil logout.');
       return Redirect('login');
    }

}
