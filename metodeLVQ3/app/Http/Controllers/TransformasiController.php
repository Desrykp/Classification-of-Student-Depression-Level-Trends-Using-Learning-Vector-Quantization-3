<?php

namespace App\Http\Controllers;

use App\Models\Normalisasi;
use App\Models\Transformasi;
use App\Models\BobotAwal;
use App\Models\BobotAwalTetap;
use App\Models\HasilPengujian;
use App\Models\PembagianData;
use App\Models\Pengujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransformasiController extends Controller
{
    public function index()
    {
        //mengambil data dari tabel transformasi yang di handle oleh model Transformasi
        $data = Transformasi::all();

        //mengembalikan atau passing (oper) data ke halaman view transformasi ->->compat = array -> variabel
        return view('transformasi', compact('data'));
    }

    public function destroy()
    {
        //Transformasi::truncate();

        //hapus seluruh isis tabel normalisasi
        Normalisasi::truncate();

        //hapus seluruh isi tabel bobot awal
        BobotAwal::truncate();

        //hapus seluruh isi tabel bobot awal tetap
        BobotAwalTetap::truncate();

        //hapus seluruh isi tabel pembagian data
        PembagianData::truncate();

        //hapus seluruh isi tabel hasil pengujian
        HasilPengujian::truncate();

        //kembali ke halaman sebelumnya dengan pesan data berhasil di hapus
        return back()->with('sukses', 'Data Berhasil Dihapus');;
    }

    public function normalisasi()
    {
        //ambil atau panggil tabel normalisasi
        Normalisasi::truncate();

        //ambil atau panggil tabel bobot awal
        BobotAwal::truncate();

        //ambil atau panggil tabel bobot awal tetap
        BobotAwalTetap::truncate();

        //mencari nilai minimum setiap kolom pada tabel data transformasi
        $semesterMin = Transformasi::min('semester');
        $x1Min = Transformasi::min('x1');
        $x2Min = Transformasi::min('x2');
        $x3Min = Transformasi::min('x3');
        $x4Min = Transformasi::min('x4');
        $x5Min = Transformasi::min('x5');
        $x6Min = Transformasi::min('x6');
        $x7Min = Transformasi::min('x7');
        $x8Min = Transformasi::min('x8');
        $x9Min = Transformasi::min('x9');

        // mencari nilai maksimum setiap kolom pada tabel data transformasi
        $semesterMax = Transformasi::max('semester');
        $x1Max = Transformasi::max('x1');
        $x2Max = Transformasi::max('x2');
        $x3Max = Transformasi::max('x3');
        $x4Max = Transformasi::max('x4');
        $x5Max = Transformasi::max('x5');
        $x6Max = Transformasi::max('x6');
        $x7Max = Transformasi::max('x7');
        $x8Max = Transformasi::max('x8');
        $x9Max = Transformasi::max('x9');

        //mengambil data dari tabel tansformasi yang di handle oleh model Transformasi
        $data = Transformasi::all();

        //perulangan tabel data transformasi setiap atau per baris untuk dinormalisasi
        foreach ($data as $row) {

            //inisialisasi normalisasi
            //objek normalisasi
            $normalisasi = new Normalisasi;

            //rumus min-max normalisasi kolom semester
            //pembilang
            $atas = $row->semester - $semesterMin;
            //penyebut
            $bawah = $semesterMax - $semesterMin;
            $semester = $atas / $bawah;

            //rumus min-max normalisasi kolom x1
            $atas1 = $row->x1 - $x1Min;
            $bawah1 = $x1Max - $x1Min;
            $x1 = $atas1 / $bawah1;

            //rumus min-max normalisasi kolom x2
            $atas2 = $row->x2 - $x2Min;
            $bawah2 = $x2Max - $x2Min;
            $x2 = $atas2 / $bawah2;

            //rumus min-max normalisasi kolom x3
            $atas3 = $row->x3 - $x3Min;
            $bawah3 = $x3Max - $x3Min;
            $x3 = $atas3 / $bawah3;

            //rumus min-max normalisasi kolom x4
            $atas4 = $row->x4 - $x4Min;
            $bawah4 = $x4Max - $x4Min;
            $x4 = $atas4 / $bawah4;

            //rumus min-max normalisasi kolom x5
            $atas5 = $row->x5 - $x5Min;
            $bawah5 = $x5Max - $x5Min;
            $x5 = $atas5 / $bawah5;

            //rumus min-max normalisasi kolom x6
            $atas6 = $row->x6 - $x6Min;
            $bawah6 = $x6Max - $x6Min;
            $x6 = $atas6 / $bawah6;

            //rumus min-max normalisasi kolom x7
            $atas7 = $row->x7 - $x7Min;
            $bawah7 = $x7Max - $x7Min;
            $x7 = $atas7 / $bawah7;

            //rumus min-max normalisasi kolom x8
            $atas8 = $row->x8 - $x8Min;
            $bawah8 = $x8Max - $x8Min;
            $x8 = $atas8 / $bawah8;

            //rumus min-max normalisasi kolom x9
            $atas9 = $row->x9 - $x9Min;
            $bawah9 = $x9Max - $x9Min;
            $x9 = $atas9 / $bawah9;

            //tampilkan data normalisasi setiap kolom per baris dimana yang diambil hanya 2 agka di belakang koma
            $normalisasi->no = $row->no;
            $normalisasi->jk = number_format($row->jk, 2);
            $normalisasi->semester = number_format($semester, 2);
            $normalisasi->x1 = number_format($x1, 2);
            $normalisasi->x2 = number_format($x2, 2);
            $normalisasi->x3 = number_format($x3, 2);
            $normalisasi->x4 = number_format($x4, 2);
            $normalisasi->x5 = number_format($x5, 2);
            $normalisasi->x6 = number_format($x6, 2);
            $normalisasi->x7 = number_format($x7, 2);
            $normalisasi->x8 = number_format($x8, 2);
            $normalisasi->x9 = number_format($x9, 2);
            $normalisasi->kelas = $row->kelas;

            //simpan data hasil normalisasi
            $normalisasi->save();
        }

        // menentukan bobot awal
        //ambil data dari tabel normalisasi dimana kelas nilainya 1, 2, 3, ambil 2 array teratas. jika sudah 2 maka tidak ambil lagi
        $kelas1 = Normalisasi::where('kelas', 1)->take(2)->get();
        $kelas2 = Normalisasi::where('kelas', 2)->take(2)->get();
        $kelas3 = Normalisasi::where('kelas', 3)->take(2)->get();

        //perulangan bobot
        //perbaris berdasarkan kelas
        foreach ($kelas1 as $key => $row1) {
            //nomro data bobot pertama diinisialisasi w1
            $nomor = 'w1' . ++$key;

            //inisialisasi bobot awal
            $bobotawal = new BobotAwal;

            //data setiap kolom bobot
            $bobotawal->no = $row1->no;
            $bobotawal->inisial = $nomor;
            $bobotawal->jk = $row1->jk;
            $bobotawal->semester = $row1->semester;
            $bobotawal->x1 = $row1->x1;
            $bobotawal->x2 = $row1->x2;
            $bobotawal->x3 = $row1->x3;
            $bobotawal->x4 = $row1->x4;
            $bobotawal->x5 = $row1->x5;
            $bobotawal->x6 = $row1->x6;
            $bobotawal->x7 = $row1->x7;
            $bobotawal->x8 = $row1->x8;
            $bobotawal->x9 = $row1->x9;
            $bobotawal->kelas = $row1->kelas;

            //simpan bobot awal
            $bobotawal->save();

            //inisialisasi bobot awaltetap
            $pengujian = new BobotAwalTetap;

            //data setiap kolom bobot
            $pengujian->no = $row1->no;
            $pengujian->inisial = $nomor;
            $pengujian->jk = $row1->jk;
            $pengujian->semester = $row1->semester;
            $pengujian->x1 = $row1->x1;
            $pengujian->x2 = $row1->x2;
            $pengujian->x3 = $row1->x3;
            $pengujian->x4 = $row1->x4;
            $pengujian->x5 = $row1->x5;
            $pengujian->x6 = $row1->x6;
            $pengujian->x7 = $row1->x7;
            $pengujian->x8 = $row1->x8;
            $pengujian->x9 = $row1->x9;
            $pengujian->kelas = $row1->kelas;

            //simpan bobot awal
            $pengujian->save();
        }

        foreach ($kelas2 as $key => $row2) {
            $nomor = 'w2' . ++$key;
            $bobotawal = new BobotAwal;
            $bobotawal->no = $row2->no;
            $bobotawal->inisial = $nomor;
            $bobotawal->jk = $row2->jk;
            $bobotawal->semester = $row2->semester;
            $bobotawal->x1 = $row2->x1;
            $bobotawal->x2 = $row2->x2;
            $bobotawal->x3 = $row2->x3;
            $bobotawal->x4 = $row2->x4;
            $bobotawal->x5 = $row2->x5;
            $bobotawal->x6 = $row2->x6;
            $bobotawal->x7 = $row2->x7;
            $bobotawal->x8 = $row2->x8;
            $bobotawal->x9 = $row2->x9;
            $bobotawal->kelas = $row2->kelas;
            $bobotawal->save();
            $no = 0;
            $pengujian = new BobotAwalTetap;
            $pengujian->no = $row2->no;
            $pengujian->inisial = $nomor;
            $pengujian->jk = $row2->jk;
            $pengujian->semester = $row2->semester;
            $pengujian->x1 = $row2->x1;
            $pengujian->x2 = $row2->x2;
            $pengujian->x3 = $row2->x3;
            $pengujian->x4 = $row2->x4;
            $pengujian->x5 = $row2->x5;
            $pengujian->x6 = $row2->x6;
            $pengujian->x7 = $row2->x7;
            $pengujian->x8 = $row2->x8;
            $pengujian->x9 = $row2->x9;
            $pengujian->kelas = $row2->kelas;
            $pengujian->save();
        }

        foreach ($kelas3 as $key => $row3) {
            $nomor = 'w3' . ++$key;
            $bobotawal = new BobotAwal;
            $bobotawal->no = $row3->no;
            $bobotawal->inisial = $nomor;
            $bobotawal->jk = $row3->jk;
            $bobotawal->semester = $row3->semester;
            $bobotawal->x1 = $row3->x1;
            $bobotawal->x2 = $row3->x2;
            $bobotawal->x3 = $row3->x3;
            $bobotawal->x4 = $row3->x4;
            $bobotawal->x5 = $row3->x5;
            $bobotawal->x6 = $row3->x6;
            $bobotawal->x7 = $row3->x7;
            $bobotawal->x8 = $row3->x8;
            $bobotawal->x9 = $row3->x9;
            $bobotawal->kelas = $row3->kelas;
            $bobotawal->save();
            $no = 0;
            $pengujian = new BobotAwalTetap;
            $pengujian->no = $row3->no;
            $pengujian->inisial = $nomor;
            $pengujian->jk = $row3->jk;
            $pengujian->semester = $row3->semester;
            $pengujian->x1 = $row3->x1;
            $pengujian->x2 = $row3->x2;
            $pengujian->x3 = $row3->x3;
            $pengujian->x4 = $row3->x4;
            $pengujian->x5 = $row3->x5;
            $pengujian->x6 = $row3->x6;
            $pengujian->x7 = $row3->x7;
            $pengujian->x8 = $row3->x8;
            $pengujian->x9 = $row3->x9;
            $pengujian->kelas = $row3->kelas;
            $pengujian->save();
        }

        //alihkan halaman kembali / kembali ke halaman link normalisasi dengan pesan data berhasil di normalisasikan
        return redirect('/normalisasi')->with('sukses', 'Data Berhasil Dinormalisasikan');;
    }
}
