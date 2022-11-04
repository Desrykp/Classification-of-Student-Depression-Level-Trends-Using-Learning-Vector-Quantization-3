<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotAwal;
use App\Models\BobotAwalTetap;
use App\Models\PembagianData;

class BobotAwalController extends Controller
{
    public function index()
    {
        //mengambil data dari tabel bobot awal yang di handle oleh model BobotAwal
        $data = BobotAwal::all();

        //mengambil data dari tabel pembagian data yang di handle oleh model PembagianData
        $pembagiandata = PembagianData::all();

        //mengambil data dari tabel bobot awal tetap yang di handle oleh model BobotAwalTetap
        $awal = BobotAwalTetap::all();

        //mengembalikan atau passing (oper) data ke halaman view bobot awal ->->compat = array -> variabel
        return view('bobotawal', compact('data', 'pembagiandata', 'awal'));
    }
}
