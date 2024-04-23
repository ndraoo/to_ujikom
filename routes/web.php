<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'store'])->name('registermasyarakat');
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['role:user']], function () {
        Route::resource('user', UserController::class);

        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/pinjam/{id}', [PeminjamanController::class, 'showForm'])->name('pinjam.form');
        Route::post('user/pinjam/buku', [PeminjamanController::class, 'pinjamBuku'])->name('pinjam.store');
        Route::get('/user/pengembalian/buku', [PeminjamanController::class, 'pengembalianIndex'])->name('user.pengembalian.form');
        Route::get('/user/form-pengembalian/{id}', [PeminjamanController::class, 'formPengembalian'])->name('user.form.pengembalian');
        Route::put('/user/update-pengembalian/{id}', [PeminjamanController::class, 'updatePengembalian'])->name('user.update.pengembalian');
        Route::get('user/ulasan/{id}', [PeminjamanController::class, 'ulasanCreate'])->name('user.ulasan.create');
        Route::post('/user/ulasan', [PeminjamanController::class, 'storeUlasan'])->name('ulasan.store');
        Route::get('/user/koleksi-saya/index', [UserController::class, 'koleksi'])->name('user.koleksi');

    });

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('admin', AdminController::class);
    //buku
    Route::get('admin/buku/index', [BukuController::class, 'index'])->name('admin.buku.index');
    Route::get('/admin/buku/create', [BukuController::class, 'create'])->name('admin.buku.create');
    Route::post('/admin/buku', [BukuController::class, 'store'])->name('admin.buku.store');
    Route::get('/admin/buku/{id}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
    Route::put('/admin/buku/{id}', [BukuController::class, 'update'])->name('admin.buku.update');
    Route::delete('/admin/buku/{id}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');
    //peminjaman
    Route::get('admin/peminjaman/index', [PeminjamanController::class, 'indexPeminjaman'])->name('admin.peminjaman.index');
    Route::put('admin/status/{id}', [PeminjamanController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/generate-pdf',[PeminjamanController::class, 'generatePDF'])->name('admin.generatePDF');
    // kategori-buku
    Route::get('admin/kategori-buku/index', [KategoriController::class, 'kategoriBukuIndex'])->name('admin.kategori.index');
    Route::get('/admin/kategori-buku/create', [KategoriController::class, 'kategoriBukuCreate'])->name('admin.kategori.create');
    Route::post('/admin/kategori-buku', [KategoriController::class, 'kategoriBukuStore'])->name('admin.kategori.store');
    Route::get('/admin/kategori-buku/{id}/edit', [KategoriController::class, 'kategoriBukuEdit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori-buku/{id}', [KategoriController::class, 'kategoriBukuUpdate'])->name('admin.kategori.update');
    Route::delete('/admin/kategori-buku/{id}', [KategoriController::class, 'kategoriBukuDestroy'])->name('admin.kategori.destroy');

    Route::get('admin/register/index', [AuthAdminController::class, 'index'])->name('admin.register.index');
    Route::get('/admin/register/create', [AuthAdminController::class, 'create'])->name('admin.register.create');
    Route::post('/admin/register/store', [AuthAdminController::class, 'store'])->name('admin.register.store');
    Route::get('/admin/register/{id}/edit', [AuthAdminController::class, 'edit'])->name('admin.register.edit');
    Route::put('/admin/register/{id}', [AuthAdminController::class, 'update'])->name('admin.register.update');
    Route::delete('/admin/register/{id}', [AuthAdminController::class, 'destroyer'])->name('admin.register.destroy');
});

Route::group(['middleware' => ['role:register']], function () {
    Route::resource('petugas', PetugasController::class);
    Route::get('petugas/buku/index', [bukuController::class, 'index'])->name('petugas.buku.index');
    Route::get('/petugas/buku/create', [bukuController::class, 'create'])->name('petugas.buku.create');
    Route::post('/petugas/buku', [bukuController::class, 'store'])->name('petugas.buku.store');
    Route::get('/petugas/buku/{id}/edit', [bukuController::class, 'edit'])->name('petugas.buku.edit');
    Route::put('/petugas/buku/{id}', [bukuController::class, 'update'])->name('petugas.buku.update');
    Route::delete('/petugas/buku/{id}', [bukuController::class, 'destroy'])->name('petugas.buku.destroy');
     //peminjaman
     Route::get('petugas/peminjaman/index', [PeminjamanController::class, 'indexPeminjaman'])->name('petugas.peminjaman.index');
     Route::put('petugas/status/{id}', [PeminjamanController::class, 'updateStatus'])->name('petugas.updateStatus');
     Route::get('/generate-pdf',[PeminjamanController::class, 'generatePDF'])->name('petugas.generatePDF');
     // kategori-buku
     Route::get('petugas/kategori-buku/index', [KategoriController::class, 'kategoriBukuIndex'])->name('petugas.kategori.index');
     Route::get('/petugas/kategori-buku/create', [KategoriController::class, 'kategoriBukuCreate'])->name('petugas.kategori.create');
     Route::post('/petugas/kategori-buku', [KategoriController::class, 'kategoriBukuStore'])->name('petugas.kategori.store');
     Route::get('/petugas/kategori-buku/{id}/edit', [KategoriController::class, 'kategoriBukuEdit'])->name('petugas.kategori.edit');
     Route::put('/petugas/kategori-buku/{id}', [KategoriController::class, 'kategoriBukuUpdate'])->name('petugas.kategori.update');
     Route::delete('/petugas/kategori-buku/{id}', [KategoriController::class, 'kategoriBukuDestroy'])->name('petugas.kategori.destroy');


});
});
