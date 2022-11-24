<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\rujukanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::post('/create_user', [App\Http\Controllers\AuthController::class, 'register'])->name('create_user');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], "prefix" => "/admin"], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('obat', App\Http\Controllers\ObatController::class);
    Route::resource('pembelian_obat_suppliers', App\Http\Controllers\PembelianObatSuppliersController::class);
    Route::resource('resep_obat', App\Http\Controllers\ResepObatController::class);
    Route::resource('resep_obat_detail', App\Http\Controllers\ResepObatDetailController::class);
    Route::resource('kategori_obat', App\Http\Controllers\KategoriObatController::class);
    Route::resource('tempat_rujukan', App\Http\Controllers\TempatRujukanController::class);
    Route::resource('user_admin', App\Http\Controllers\AdminController::class);
    Route::resource('user_dokter', App\Http\Controllers\DokterController::class);
    Route::resource('user_pasien', App\Http\Controllers\PasienController::class);
    Route::resource('spesialis', App\Http\Controllers\SpesialisController::class);
    Route::get('jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'jadwal_dokter' ])->name('jadwal_dokter');
    Route::get('form_jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'form_jadwal_dokter' ])->name('form_jadwal_dokter');
    Route::post('buat_jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'buat_jadwal_dokter' ])->name('buat_jadwal_dokter');
    Route::delete('delete_jadwal_dokter/{id}', [App\Http\Controllers\DokterHomeController::class, 'delete_jadwal_dokter' ])->name('delete_jadwal_dokter');
    Route::get('/update-status-pendaftaran/{id}', [App\Http\Controllers\LayananController::class, 'update_status_pendaftaran' ]);
    Route::resource('rujukan', App\Http\Controllers\rujukanController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    
    Route::get('/transaksi/{transaksi}', [App\Http\Controllers\TransaksiController::class,'createTransaksi'])->name('transaksi.createTransaksi');
    Route::get('listrekammedis', [App\Http\Controllers\TransaksiController::class,'listrekammedis'])->name('transaksi.listrekammedis');
    Route::get('/transaksi/{transaksi}/invoice', [App\Http\Controllers\TransaksiController::class,'print'])->name('transaksi.invoice');
    
});

Route::group(['middleware' => ['auth'], "prefix" => "/pasien"], function(){
    Route::get('/dashboard', [App\Http\Controllers\PasienHomeController::class, 'index'])->name('pasien_home');
    Route::get('/berobat', [App\Http\Controllers\LayananController::class, 'berobat'])->name('berobat');
    Route::get('/pasien_mendaftar/{id}', [App\Http\Controllers\LayananController::class, 'pasien_mendaftar'])->name('pasien_mendaftar');
    
});

Route::group(['middleware' => ['auth'], "prefix" => "/dokter"], function(){
    Route::get('/dashboard', [App\Http\Controllers\DokterHomeController::class, 'index'])->name('dokter_home');
    Route::resource('rekamedis', App\Http\Controllers\RekamedisController::class);
    Route::resource('dokterrujukan', App\Http\Controllers\dokterRujukanController::class);
});
