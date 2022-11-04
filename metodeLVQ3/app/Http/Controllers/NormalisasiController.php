<?php

namespace App\Http\Controllers;

use App\Models\BobotAwal;
use App\Models\BobotAwalTetap;
use App\Models\HasilPengujian;
use Illuminate\Http\Request;
use App\Models\Normalisasi;
use App\Models\PembagianData;

class NormalisasiController extends Controller
{
    public function index()
    {
        //mengambil data dari tabel normasilasi yang di handle oleh model Normalisasi
        $data = Normalisasi::all();

        //mengembalikan atau passing (oper) data ke halaman view bobot awal ->compat = array -> variabel
        return view('normalisasi', compact('data'));
    }

    public function destroy()
    {
        //hapus seluruh isi tabel normalisasi
        Normalisasi::truncate();

        //hapus seluruh isi tabel bobot awal tetap
        BobotAwalTetap::truncate();

        //hapus seluruh isi tabel bobot awal
        BobotAwal::truncate();

        //hapuus seluruh isi tabel hasil pengujian
        HasilPengujian::truncate();

        //hapus seluruh isi tabel pembagian data
        PembagianData::truncate();

        //kembali ke halaman sebelumnya dan menampilkan pesan data berhasil dihapus
        return back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
