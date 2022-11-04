<?php

use App\Http\Controllers\DataAwalController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\TransformasiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\BobotAwalController;
use App\Http\Controllers\HalamanBaruController;
use App\Http\Controllers\PengujianController;
use Illuminate\Support\Facades\Route;

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

//post data dikirim melalui form (menanganis sebuah form untuk menerima hasil inputan)
//get menampilkan resource berupa fungsi atau controller

Route::get('/', function () {
    return view('welcome');
});

//pada saat hallaman utama (/dataawal) diakses, maka akan dijalankan fungsion index pada controller dataawalcontroller
Route::get('/', [DataAwalController::class, 'index']);

//dari web.php dikirim ke controller datawal controller untuk di proses pada fungsion create -> nama routenya post.gejalaawal
Route::post('/postdatagejala', [DataAwalController::class, 'create'])->name('post.datagejalaawal');

//pada saat hapus data gejala berdasarkan id diakses, maka akan dijalankan fungsion destroy pada controller dataawalcontroller
Route::get('/datagejala/{id}/delete', [DataAwalController::class, 'destroy']);


//pada saat ransformasi dtaa gejala diakses, maka akan dijalankan fungsion transformasi pada controller dataawalcontroller
Route::get('/datagejala/transformasi', [DataAwalController::class, 'transformasi']);

//dari web.php dikirim lagi ke controller supaya bisa diproses , contohnya diatas di difunction importdata
Route::post('/datagejala/import', [DataAwalController::class, 'importdata'])->name('datagejala.import');


//pada saat hapus semua data gejala diakses, maka akan dijalankan fungsion destroyall pada controller dataawalcontroller
Route::get('/datagejala/destroy', [DataAwalController::class, 'destroyall']);



//pada saat transformasi diakses, maka akan dijalankan fungsion index pada controller transformasicontroller
Route::get('/transformasi', [TransformasiController::class, 'index']);

//pada saat hapus tabel transformasi diakses, maka akan dijalankan fungsion destroy pada controller transformasicontroller
Route::get('/transformasi/destroy', [TransformasiController::class, 'destroy']);

//pada saat normalisasi diakses, maka akan dijalankan fungsion normalisasi pada controller transformasicontroller
Route::get('/transformasi/normalisasi', [TransformasiController::class, 'normalisasi']);



//pada saat normalisasi diakses, maka akan dijalankan fungsion index pada controller normalisasicontroller
Route::get('/normalisasi', [NormalisasiController::class, 'index']);

//pada saat haous tabel normalisasi diakses, maka akan dijalankan fungsion destroy pada controller normalisasicontroller
Route::get('/normalisasi/destroy', [NormalisasiController::class, 'destroy']);



//pada saat bobotawal diakses, maka akan dijalankan fungsion index pada controller bobotawalcontroller
Route::get('/bobotawal', [BobotAwalController::class, 'index']);



//pada saat pelatihan diakses, maka akan dijalankan fungsion index pada controller pelatihancontroller
Route::get('/pelatihan', [PelatihanController::class, 'index']);

//pada saat form pelatihan diakses, maka akan dijalankan fungsion cretae pada controller pelatihancontroller -> nama post.pelatihan
Route::post('/pelatihan/post', [PelatihanController::class, 'create'])->name('post.pelatihan');



//pada saat pengujian diakses, maka akan dijalankan fungsion index pada controller pengujiancontroller
Route::get('/pengujian', [PengujianController::class, 'index']);

//pada saat proses pengujian diakses, maka akan dijalankan fungsion prosespengujian pada controller pengujiancontroller
Route::get('/pengujian/proses', [PengujianController::class, 'prosespengujian']);
