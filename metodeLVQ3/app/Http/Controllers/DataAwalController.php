<?php

namespace App\Http\Controllers;

use App\Imports\DataAwalImport;
use App\Models\BobotAwal;
use App\Models\BobotAwalTetap;
use App\Models\DataAwal;
use App\Models\HasilPengujian;
use App\Models\Normalisasi;
use App\Models\PembagianData;
use App\Models\Transformasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataAwalController extends Controller
{

    public function index()
    {
        //mengambil data dari tabel data awal yang di handle oleh model DataAwal
        $data = DataAwal::all();

        //mengembalikan atau passing (oper) data ke halaman view bobot awal ->->compat = array -> variabel
        return view('dataawal', compact('data'));
    }

    //menamngkap data degan keterangan Request -> variable $requents untuk menyimpan data yang dikirim dri form
    //setiap menggunakan post itu ada request untuk ngambil data yang dikirim dari view tadi
    public function create(Request $request)
    {
        //inisialisasi data awal berdasarkan imputan (request)
        //membuat objek
        $data = new DataAwal;

        //data per kolom berdasarkan inputan user
        //data nama adalah data nama dari input user
        $data->nama = $request->nama;
        $data->jk = $request->jk;
        $data->semester = $request->semester;
        $data->x1 = $request->x1;
        $data->x2 = $request->x2;
        $data->x3 = $request->x3;
        $data->x4 = $request->x4;
        $data->x5 = $request->x5;
        $data->x6 = $request->x6;
        $data->x7 = $request->x7;
        $data->x8 = $request->x8;
        $data->x9 = $request->x9;
        //total berdasasrkan jumlah seluruh dari data gejala depresi berdasasrkan input user
        $total = $request->x1 + $request->x2 + $request->x3 + $request->x4 + $request->x5 + $request->x6 + $request->x7 + $request->x8 + $request->x9;
        $data->total = $total;

        //klasifikasi kelas depresi
        //jika data totalnya <= 10 maka kelas depresi ringan
        if ($total <= 9) {
            $kelas = 'Ringan';
            // ringan

            //jika data totalnya <= 10 maka kelas depresi sedang
        } elseif ($total <= 19) {
            $kelas = 'Sedang';
            // sendang

            //jika data totalnya <= 10 maka kelas depresi berat
        } else {
            $kelas = 'Berat';
            // berat
        }

        //data kelas berdasarkan perulangan klasifikasi kelas depresi
        $data->kelas = $kelas;
        // dd($kelas);

        //simpan data
        $data->save();

        //kembali ke halaman sebelumnya
        return back();
    }

    //hapus berdasarkan id
    public function destroy($id)
    {
        //seleksi data awal berdasarkan id yang di handle oleh model DataAwal
        $data = DataAwal::find($id);

        //hapus data berdasarkan id
        $data->delete();

        //kembali ke halam sebelumnya dengan pesan data berhasil di hapus
        return back()->with('sukses', 'Data Berhasil Dihapus');;
    }

    public function Transformasi()
    {
        // Transformasi::truncate();
        //mengambil atau memanggil tabel trasnformasi yang di handle oleh model Transformasi
        $DelTransformas = Transformasi::truncate();

        //mengambil data dari tabel data awal yang di handle oleh model DataAwal
        $data = DataAwal::all();

        //perulangan trasnfromasi data per atau setiap baris
        foreach ($data as $key => $row) {

            //inisialisasi transformasi
            //membuat objek transformasi
            $transformasi = new Transformasi;

            //nomor bertambah setiap perulangan
            $transformasi->no = ++$key;

            //perulangan jika laki-laki di transformasi menjadi 1 -> huruf besar kecil
            if ($row->jk == 'Laki-Laki' || $row->jk == 'Laki-laki' || $row->jk == 'laki-Laki' || $row->jk == 'laki-laki') {
                $transformasi->jk = 1;

                //perulangan jika perempuan di transformasi menjadi 0 -> huruf besar kecil
            } elseif ($row->jk == 'Perempuan' || $row->jk == 'perempuan') {
                $transformasi->jk = 0;

                //perulangan jika tidak keduanya maka null
            } else {
                $transformasi->jk = null;
            }

            //data transformasi setiap kolom
            $transformasi->semester = $row->semester;
            $transformasi->x1 = $row->x1;
            $transformasi->x2 = $row->x2;
            $transformasi->x3 = $row->x3;
            $transformasi->x4 = $row->x4;
            $transformasi->x5 = $row->x5;
            $transformasi->x6 = $row->x6;
            $transformasi->x7 = $row->x7;
            $transformasi->x8 = $row->x8;
            $transformasi->x9 = $row->x9;

            //transformasi kelas
            //jika baris kelas = berat, maka kelas di transformasi menjadi 3
            if ($row->kelas == 'Berat') {
                $transformasi->kelas = 3;

                //jika baris kelas = berat, maka kelas di transformasi menjadi 2
            } elseif ($row->kelas == 'Sedang') {
                $transformasi->kelas = 2;

                //jika baris kelas = berat, maka kelas di transformasi menjadi 1
            } elseif ($row->kelas == 'Ringan') {
                $transformasi->kelas = 1;
            }

            //simpan data transformasi
            $transformasi->save();
        }

        //alihkan halaman kembali / kembali ke halaman link transformasi dengan pesan data berhasil di transformasikan
        return redirect('/transformasi')->with('sukses', 'Data Berhasil Ditransformasi');;
    }

    //fungsi import data berdasarkan inut user
    //setiap menggunakan post itu ada request untuk ngambil data yang dikirim dari view tadi
    public function importdata(Request $request)
    {
        // DataAwal::truncate();

        //proses mendapatkan data import dan memindahkan file import ke data awal
        //menangkap file excel
        $file = $request->file('fileImport');

        //membuat nama file
        $namaFile = $file->getClientOriginalName();

        //upload ke folder DataAawal di dalam folderpublic
        $file->move('DataAwal', $namaFile);

        //import data -> pergi cari file excelnya dengan public_path
        Excel::import(new DataAwalImport, public_path('/DataAwal/' . $namaFile));

        //kembali ke link data awal (alihkan halaman kembali) dengan pesan sukses disimpan
        return redirect('/')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function destroyall()
    {
        //hapus isi tabel trasnformasi berdasarkan model transformasi
        Transformasi::truncate();

        //hapus isi tabel data awal berdasarkan model data awal
        DataAwal::truncate();

        //hapus isi tabel normalisasi berdasarkan model normalisasi
        Normalisasi::truncate();

        //hapus isi tabel bobot awal tetap berdasarkan model bobot awal tetap
        BobotAwalTetap::truncate();

        //hapus isi tabel bobot awal berdasarkan model bobot awal
        BobotAwal::truncate();

        //hapus isi tabel hasil pengujian berdasarkan model hasil pegujian
        HasilPengujian::truncate();

        //hapus isi tabel pengambilan data berdasarkan model pengambilan data
        PembagianData::truncate();

        //kembali ke halam sebelumya dnegan menampilkan pesan data berhasil di hapus
        return back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
