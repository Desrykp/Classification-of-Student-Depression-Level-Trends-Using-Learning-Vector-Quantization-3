<?php

namespace App\Http\Controllers;

use App\Models\BobotAwal;
use App\Models\HasilPengujian;
use App\Models\Normalisasi;
use App\Models\PembagianData;
use App\Models\PerhitunganPelatihan;
use Illuminate\Http\Request;

class PengujianController extends Controller
{

    public function index()
    {
        // HasilPengujian::truncate();
        //ambil atau panggil tabel hasil pengujia yg dihandle oleh model hasil pengujian
        $data = HasilPengujian::all();

        //TP = hasil pengujian dimana kelas data uji =1 kelas lvq 3 =1, hitung
        $ringansama = HasilPengujian::where('kelas_data_uji', 1)->where('kelas_lvq3', 1)->count();

        //FP = hasil pengujian dimana kelas data uji =1 kelas lvq 3 =2, hitung
        $ringansedang = HasilPengujian::where('kelas_data_uji', 1)->where('kelas_lvq3', 2)->count();

        //FN = hasil pengujian dimana kelas data uji =2 kelas lvq 3 =1, hitung
        $sedangringan = HasilPengujian::where('kelas_data_uji', 2)->where('kelas_lvq3', 1)->count();


        //TN = hasil pengujian dimana kelas data uji =2 kelas lvq 3 =2, hitung
        $sedangsama = HasilPengujian::where('kelas_data_uji', 2)->where('kelas_lvq3', 2)->count();

        //TN = hasil pengujian dimana kelas data uji =2 kelas lvq 3 =3, hitung
        $sedangberat = HasilPengujian::where('kelas_data_uji', 2)->where('kelas_lvq3', 3)->count();

        //TN = hasil pengujian dimana kelas data uji =3 kelas lvq 3 =2, hitung
        $beratsedang = HasilPengujian::where('kelas_data_uji', 3)->where('kelas_lvq3', 2)->count();


        //TN = hasil pengujian dimana kelas data uji =3 kelas lvq 3 =3, hitung
        $beratsama = HasilPengujian::where('kelas_data_uji', 3)->where('kelas_lvq3', 3)->count();

        //FP = hasil pengujian dimana kelas data uji =1 kelas lvq 3 =3, hitung
        $ringanberat = HasilPengujian::where('kelas_data_uji', 1)->where('kelas_lvq3', 3)->count();

        //FN = hasil pengujian dimana kelas data uji =3 kelas lvq 3 =1, hitung
        $beratringan = HasilPengujian::where('kelas_data_uji', 3)->where('kelas_lvq3', 1)->count();

        //$counth=$data->count();
        //hitung connfusion matrix penyebut
        $counth = $sedangsama + $sedangberat + $beratsedang + $beratsama + $sedangringan + $beratringan + $ringansama + $ringansedang + $ringanberat;

        //hitung confusion matrix pembilang
        $penambahan = $ringansama + $sedangsama + $beratsama;

        //hasil bagi pembilang / penyebut dikali 100
        $h1 = $penambahan * 100;

        //jika penyebut = 0 AND pembilang = 0
        if ($counth == 0 && $penambahan == 0) {

            //maka hasil confusion matrix = 0
            $hasilpembagian = 0;

            //jika tidak
        } else {

            //maka hasil confusion matrix adalah penyebut dikali embilang. jika hasilnya koma maka ambil 2 angka dibelakng koma
            $hasilpembagian = number_format($h1 / $counth, 2);
        }

        //jika , pembagian data null
        if (PembagianData::find(1) == null) {

            //maka learning rate = 0
            $learningrate = 0;

            //window 0;
            $window = 0;

            //jika tidak
        } else {

            //tampilkan learning rate
            $learningrate = PembagianData::find(1)->learningrate;

            //tampilkan window
            $window = PembagianData::find(1)->window;
        }

        //mengembalikan atau passing (oper) data ke halaman view pengujian ->->compat = array -> variabel
        return view('pengujian', compact('window', 'learningrate', 'data', 'counth', 'hasilpembagian', 'ringansama', 'ringansedang', 'sedangringan', 'sedangsama', 'sedangberat', 'beratsedang', 'beratsama', 'ringanberat', 'beratringan'));
    }

    public function prosespengujian()
    {

        //ambil atau panggil tabel hasil pengujian
        HasilPengujian::truncate();

        //temukan pembagian data yang dipilih
        $dDataLatih = PembagianData::find(1);
        // dd($dDataLatih);

        //ambil tabel normalisasi kemudian skip data latih, ambil data uji
        $dataNormalisasi = Normalisasi::skip($dDataLatih->dLatih)->take($dDataLatih->dUji)->get();


        //perulangan pengujian
        //perulangan data uji dari tabel data normalisasi per baris data
        foreach ($dataNormalisasi as $rownormalisasi) {

            //ambil atau panggil tabel perhitungan pelatihan
            //berisi bobot akhir hasil pengujian
            PerhitunganPelatihan::truncate();

            //id data uji normalisasi perbaris berdsarkan id
            $idnormalisasi = $rownormalisasi->id;

            // perulangan ecludean data bobot akhir hasil pelatihan dan data uji
            //ambil atau panggil tabel bobot awal -> seluruh tabel bobot awal
            $databobotawal = BobotAwal::all();

            //perulangan ecludean per 1 data uji dengan seluruh bobot perbaris
            foreach ($databobotawal as $key => $rowbobot) {

                //ambil data uji normalisasi berdasarkan id, lakukan perhitunga jarak ecludean
                $dataaa = $rownormalisasi->id =
                    pow($rowbobot->jk - $rownormalisasi->jk, 2) + pow($rowbobot->semester - $rownormalisasi->semester, 2) + pow($rowbobot->x1 - $rownormalisasi->x1, 2) +
                    pow($rowbobot->x2 - $rownormalisasi->x2, 2) + pow($rowbobot->x3 - $rownormalisasi->x3, 2) + pow($rowbobot->x4 - $rownormalisasi->x4, 2) +
                    pow($rowbobot->x5 - $rownormalisasi->x5, 2) + pow($rowbobot->x6 - $rownormalisasi->x6, 2) + pow($rowbobot->x7 - $rownormalisasi->x7, 2) +
                    pow($rowbobot->x8 - $rownormalisasi->x8, 2) + pow($rowbobot->x9 - $rownormalisasi->x9, 2) + pow($rowbobot->kelas - $rownormalisasi->kelas, 2);

                //hasilnya diakarkan
                $hasil = sqrt($dataaa);
                // dd($hasil);

                //hasil ecludean untuk disimpan dan ditentukan dr = min(d)
                //inisialisasi perhitungan pengujian
                //objek
                $insertPerhitungan = new PerhitunganPelatihan;

                //bobot awal hasil perhitungan pelatihan berdasarkan id bobot
                $insertPerhitungan->bobotawal_id = $rowbobot->id;

                //data latih berdasarkan id
                $insertPerhitungan->normalisasi_id = $idnormalisasi;

                //bobot
                $insertPerhitungan->inisial = $rowbobot->inisial;

                //kelas dari bobot
                $insertPerhitungan->kelas = $rowbobot->kelas;

                //hasil perhitungan ecludean
                $insertPerhitungan->hasil = $hasil;

                //simpan hasil perhitungan
                $insertPerhitungan->save();
                //new

            }

            //hasil 2 terbaik
            //ambil 1 data dari hasil 2 terbaik yaitu Dc dan Dr disusun ascending
            $hasilpelatihan = PerhitunganPelatihan::orderBy('hasil', 'asc')->take(1)->get();

            //ambil kelas dari dr -> hasil dr atau d1 adalah hasil perhitungan ecludean pada indeks 0
            $dr = $hasilpelatihan[0]->kelas;

            //kelas data uji
            $kelasnormalisasi = $rownormalisasi->kelas;
            // dd($hasilpelatihan);

            //jika kelas dr sama dengan kelas data uji
            if ($dr == $kelasnormalisasi) {

                //maka benar
                $hasil = 'Benar';

                //jika tidak
            } else {

                //maka salah
                $hasil = 'Salah';
            }

            //inisialisasi hasil pengujian
            //simpan hasil pngujian dr =min(d)
            //objek
            $hasilpengujian = new HasilPengujian;

            //kolom data ke adlah data uji indeks 0 id data uji
            $hasilpengujian->data_ke = $hasilpelatihan[0]->normalisasi_id;

            //kelas data uji
            $hasilpengujian->kelas_data_uji = $kelasnormalisasi;

            //kelas lvq adalh kelas dari dr
            $hasilpengujian->kelas_lvq3 = $dr;

            //keterangan benar salah
            $hasilpengujian->keterangan = $hasil;

            //simpan hasil pengujian
            $hasilpengujian->save();
        }

        //kembali ke halaman sebelumnya dengan pesan pengujian berhasil
        return back()->with('sukses', 'Pengujian Berhasil');
    }
}
