<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Normalisasi;
use App\Models\BobotAwal;
use App\Models\HasilPengujian;
use App\Models\Pelatihan;
use App\Models\PembagianData;
use App\Models\PerhitunganPelatihan;
use App\Models\Transformasi;
use PhpParser\Node\Stmt\Foreach_;

class PelatihanController extends Controller
{
    public function index()
    {
        //mengambil data dari tabel bobtawal yang di handle oleh model BoboyAwal
        $data = BobotAwal::all();

        //hitung data transformasi
        $countTransformasi = Transformasi::count();

        //pembagian data
        //pembagian data latih 90% -> seluruh data transformasi dikali 0.9
        $p90 = $countTransformasi * 0.9;

        //pembagian data latih 80% -> seluruh data transformasi dikali 0.8
        $p80 = $countTransformasi * 0.8;

        //pembagian data latih 70% -> seluruh data transformasi dikali 0.7
        $p70 = $countTransformasi * 0.7;

        //pembagian data uji 10% -> seluruh data transformasi dikali 0.1
        $p10 = $countTransformasi * 0.1;

        //pembagian data uji 20% -> seluruh data transformasi dikali 0.2
        $p20 = $countTransformasi * 0.2;

        //pembagian data uji 30% -> seluruh data transformasi dikali 0.3
        $p30 = $countTransformasi * 0.3;

        //mengembalikan atau passing (oper) data ke halaman view pelatihan
        return view('pelatihan', compact('data', 'p90', 'p80', 'p70', 'p10', 'p20', 'p30'));
    }

    //menamngkap data degan keterangan Request -> variable $req untuk menyimpan data yang dikirim dri form
    public function create(Request $req)
    {

        //data pembagian Data
        //hitung data transformasi
        $countTransformasi = Transformasi::count();
        // dd($req->all());

        //panggil tabel pembagian data
        PembagianData::truncate();

        //masukan parameter pembelajaran
        //jika user memilih pembagian data 90:10
        if ($req->pembagiandata == 'p91') {
            // dd($req->all());

            //inisialisasi pembagian data
            //objek
            $pembagian = new PembagianData;

            //input learning rate
            $pembagian->learningrate = $req->learningRate;

            //input window
            $pembagian->window = $req->window;

            //input data latih 90%
            $pembagian->dLatih = $countTransformasi * 0.9;

            //input data uji 10%
            $pembagian->dUji = $countTransformasi * 0.1;

            //simpan inputan
            $pembagian->save();

            //menentukan pembagian data
            //jika user memilih pembagian data 80:20
        } elseif ($req->pembagiandata == 'p82') {

            //inisialisasi pembagian data
            $pembagian = new PembagianData;

            //input learning rate
            $pembagian->learningrate = $req->learningRate;

            //input window
            $pembagian->window = $req->window;

            //input data latih 80%
            $pembagian->dLatih = $countTransformasi * 0.8;

            //input data uji 20%
            $pembagian->dUji = $countTransformasi * 0.2;

            //simpan inputan
            $pembagian->save();

            //jika user memilih pembagian data 70:30
        } elseif ($req->pembagiandata == 'p73') {

            //inisialisasi pembagian data
            $pembagian = new PembagianData;

            //input learning rate
            $pembagian->learningrate = $req->learningRate;

            //input window
            $pembagian->window = $req->window;

            //input data latih 70%
            $pembagian->dLatih = $countTransformasi * 0.7;

            //input data uji 30%
            $pembagian->dUji = $countTransformasi * 0.3;

            //simpan inputan
            $pembagian->save();

            //jika tidak
        } else {

            //kembali ke halam sebelumnya dengan menampilkan pesan gagal menyimpan data pembagian
            return back()->with('sukses', 'Gagal Menyimpan Data Pembagian');
        }

        //proses pelatihan
        //perhitungan pelatihan
        //seleksi 1 pembagian data latih
        $dDataLatih = PembagianData::find(1)->dLatih;

        //ambil data latih normalisasi berdasasrkan id dan ascending->ampil data latih yang dipilih->panggil data
        $dataNormalisasi = Normalisasi::orderBy('id', 'ASC')->take($dDataLatih)->get();
        // dd($dataNormalisasi);

        //learning rate input user
        $dLearningRate = $req->learningRate;

        //mina input user
        $dMina = $req->mina;

        //window input user
        $dWindow = $req->window;

        //epsilon input user
        $dEpsilon = $req->epsilon;

        //maxsepoh tetap
        $dMaxepoch = 1000;

        //epoch awal
        $dEpoch = 0;

        //pengurangan learning rate tetap
        $dPengurangan = 0.1;


        //mengambil bobot awal
        //ambil data bobotawal
        $databobotawal = BobotAwal::all();

        //perulangan pelatihan data latih dar tabel data yg telah dinormlisasi perbaris
        foreach ($dataNormalisasi as $rownormalisasi) {

            //panggil tabel pada model Perhitungan Pelatihan
            //berisi data latih, data bobot
            PerhitunganPelatihan::truncate();

            //id data latih yg telah normalisasi per baris berdasarakn id
            $idnormalisasi = $rownormalisasi->id;

            // cek kondisi a > mina OR epoh < maksepoh
            if ($dLearningRate > $dMina || $dEpoch < $dMaxepoch) {

                //perhitungan jarak euclidean
                // perulangan bobot diambil dri data bobot awal per bbaris
                foreach ($databobotawal as $key => $rowbobot) {

                    //perhitungan jarak ecludean antar data bbot dengan data latih
                    //ambil data latih normalisasi berdasarkan id, lakukan perhitunga jarak ecludean
                    $dataaa = $rownormalisasi->id =
                        pow($rowbobot->jk - $rownormalisasi->jk, 2) + pow($rowbobot->semester - $rownormalisasi->semester, 2) + pow($rowbobot->x1 - $rownormalisasi->x1, 2) +
                        pow($rowbobot->x2 - $rownormalisasi->x2, 2) + pow($rowbobot->x3 - $rownormalisasi->x3, 2) + pow($rowbobot->x4 - $rownormalisasi->x4, 2) +
                        pow($rowbobot->x5 - $rownormalisasi->x5, 2) + pow($rowbobot->x6 - $rownormalisasi->x6, 2) + pow($rowbobot->x7 - $rownormalisasi->x7, 2) +
                        pow($rowbobot->x8 - $rownormalisasi->x8, 2) + pow($rowbobot->x9 - $rownormalisasi->x9, 2) + pow($rowbobot->kelas - $rownormalisasi->kelas, 2);

                    //hasilnya diakarkan
                    $hasil = sqrt($dataaa);

                    //hasil perhitungan ecludean untuk disimpan dan ditentukan dc dan dr
                    //inisialisasi perhitungan pelatihan
                    //objek
                    $insertPerhitungan = new PerhitunganPelatihan;

                    //bobot awal hasil perhitungan pelatihan berdasarkan id bobot
                    $insertPerhitungan->bobotawal_id = $rowbobot->id;

                    //data latih berdasarkan id
                    $insertPerhitungan->normalisasi_id = $idnormalisasi;

                    //inisial bobot
                    $insertPerhitungan->inisial = $rowbobot->inisial;

                    //kelas dari bobot
                    $insertPerhitungan->kelas = $rowbobot->kelas;

                    //hasil perhitungan ecludean
                    $insertPerhitungan->hasil = $hasil;

                    //simpan hasil perhitungan
                    $insertPerhitungan->save();
                }

                //menentukan dc dan dr
                //hasil 2 terbaik yaitu Dc dan Dr disusun asending
                $hasilpelatihan = PerhitunganPelatihan::orderBy('hasil', 'asc')->take(2)->get();

                // hasil dc/d1 adalah hasil pelatihan pada indeks 0
                $d1 = $hasilpelatihan[0]->hasil;

                // hasil dc atau d1 adalah hasil pelatihan pada indeks 1
                $d2 = $hasilpelatihan[1]->hasil;

                //cek window
                //jika d1 = 0, OR d2 = 0 OR d1 0.0 OR d2 = 0.0
                if ($d1 == 0 || $d2 == 0 || $d1 == 0.0 || $d2 == 0.0) {
                    //maka hasil = 0
                    $cek1 = 0;

                    //jika tidak
                } else {
                    //maka lakukan d1 dibagi d2
                    $dCek1 = ($d1 / $d2);

                    //d2 dibagi d1
                    $dCek2 = ($d2 / $d1);

                    //cari minimum
                    $cek1 = min($dCek1, $dCek2);
                }

                //1-window
                $win1 = 1 - $dWindow;

                //1+window
                $win2 = 1 + $dWindow;

                //pembagian window 1 da window 2
                $cek2 = $win1 / $win2;

                //cek window berdasarkan hasil diatas min(dc/dr, dr/dc)>1-window/1+wndow
                if ($cek1 > $cek2) {
                    // dd('true');

                    //kelas data latih
                    $kelasLatih = $rownormalisasi->kelas;

                    //kelas Dc kelas pada indeks 0 / jarak terdekat pertama
                    $kelasDC = $hasilpelatihan[0]->kelas;

                    //kelas Dr kelas pada indeks 1 // jarak terdekat kedua
                    $kelasDR = $hasilpelatihan[1]->kelas;

                    //jika true maka update bobot berdasarkan hasil Dc Dr
                    //jika kelas data latih tidak sama dnegan kelas Dc AND kelas data latih = Dr
                    if ($kelasLatih != $kelasDC && $kelasLatih == $kelasDR) {

                        //maka perbaharui bobot awal dnegan panggil model bobot awal perbaharui pada Dc /indeks 0
                        $newBobotawal = BobotAwal::find($hasilpelatihan[0]->bobotawal_id);

                        //rumus update bobot setiap kolom. data jk bobot lama - a * (ddata jk latih lama - data jk bbot lama)
                        $newjk = $newBobotawal->jk - $dLearningRate * ($rownormalisasi->jk - $newBobotawal->jk);
                        $newsemester = $newBobotawal->semester - $dLearningRate * ($rownormalisasi->semester - $newBobotawal->semester);
                        $newx1 = $newBobotawal->x1 - $dLearningRate * ($rownormalisasi->x1 - $newBobotawal->x1);
                        $newx2 = $newBobotawal->x2 - $dLearningRate * ($rownormalisasi->x2 - $newBobotawal->x2);
                        $newx3 = $newBobotawal->x3 - $dLearningRate * ($rownormalisasi->x3 - $newBobotawal->x3);
                        $newx4 = $newBobotawal->x4 - $dLearningRate * ($rownormalisasi->x4 - $newBobotawal->x4);
                        $newx5 = $newBobotawal->x5 - $dLearningRate * ($rownormalisasi->x5 - $newBobotawal->x5);
                        $newx6 = $newBobotawal->x6 - $dLearningRate * ($rownormalisasi->x6 - $newBobotawal->x6);
                        $newx7 = $newBobotawal->x7 - $dLearningRate * ($rownormalisasi->x7 - $newBobotawal->x7);
                        $newx8 = $newBobotawal->x8 - $dLearningRate * ($rownormalisasi->x8 - $newBobotawal->x8);
                        $newx9 = $newBobotawal->x9 - $dLearningRate * ($rownormalisasi->x9 - $newBobotawal->x9);
                        $newkelas = $newBobotawal->kelas - $dLearningRate * ($rownormalisasi->kelas - $newBobotawal->kelas);
                        // dd($newBobotawal->jk);

                        //update data bobot awal setiap kolom Dc dengan mengambil 2 angka dibelakang koma
                        $newBobotawal->update([
                            'jk' => number_format($newjk, 2),
                            'semester' => number_format($newsemester, 2),
                            'x1' => number_format($newx1, 2),
                            'x2' => number_format($newx2, 2),
                            'x3' => number_format($newx3, 2),
                            'x4' => number_format($newx4, 2),
                            'x5' => number_format($newx5, 2),
                            'x6' => number_format($newx6, 2),
                            'x7' => number_format($newx7, 2),
                            'x8' => number_format($newx8, 2),
                            'x9' => number_format($newx9, 2),
                            'kelas' => number_format($newkelas, 2),
                        ]);


                        //maka perbaharui bobot awal dnegan panggil model bobot awal
                        //seleksi data bobot awal, perbaharui pada Dr /indeks 1
                        $newBobotawal1 = BobotAwal::find($hasilpelatihan[1]->bobotawal_id);

                        //rumus update bobot setiap kolom. data jk bobot lama - a * (ddata jk latih lama - data jk bbot lama)
                        $newjk = $newBobotawal1->jk + $dLearningRate * ($rownormalisasi->jk - $newBobotawal1->jk);
                        $newsemester = $newBobotawal1->semester + $dLearningRate * ($rownormalisasi->semester - $newBobotawal1->semester);
                        $newx1 = $newBobotawal1->x1 + $dLearningRate * ($rownormalisasi->x1 - $newBobotawal1->x1);
                        $newx2 = $newBobotawal1->x2 + $dLearningRate * ($rownormalisasi->x2 - $newBobotawal1->x2);
                        $newx3 = $newBobotawal1->x3 + $dLearningRate * ($rownormalisasi->x3 - $newBobotawal1->x3);
                        $newx4 = $newBobotawal1->x4 + $dLearningRate * ($rownormalisasi->x4 - $newBobotawal1->x4);
                        $newx5 = $newBobotawal1->x5 + $dLearningRate * ($rownormalisasi->x5 - $newBobotawal1->x5);
                        $newx6 = $newBobotawal1->x6 + $dLearningRate * ($rownormalisasi->x6 - $newBobotawal1->x6);
                        $newx7 = $newBobotawal1->x7 + $dLearningRate * ($rownormalisasi->x7 - $newBobotawal1->x7);
                        $newx8 = $newBobotawal1->x8 + $dLearningRate * ($rownormalisasi->x8 - $newBobotawal1->x8);
                        $newx9 = $newBobotawal1->x9 + $dLearningRate * ($rownormalisasi->x9 - $newBobotawal1->x9);
                        $newkelas = $newBobotawal1->kelas + $dLearningRate * ($rownormalisasi->kelas - $newBobotawal1->kelas);
                        // dd($newjk);

                        //update data bobot awal setiap kolom Dr dengan mengambil 2 angka dibelakang koma
                        $newBobotawal1->update([
                            'jk' => number_format($newjk, 2),
                            'semester' => number_format($newsemester, 2),
                            'x1' => number_format($newx1, 2),
                            'x2' => number_format($newx2, 2),
                            'x3' => number_format($newx3, 2),
                            'x4' => number_format($newx4, 2),
                            'x5' => number_format($newx5, 2),
                            'x6' => number_format($newx6, 2),
                            'x7' => number_format($newx7, 2),
                            'x8' => number_format($newx8, 2),
                            'x9' => number_format($newx9, 2),
                            'kelas' => number_format($newkelas, 2),
                        ]);

                        //jika kondisi if adalah false, maka lakukan else if
                        //jika kelas data latih = kelas Dc AND kelas data latih = kelas Dr
                    } elseif ($kelasLatih == $kelasDC && $kelasDC == $kelasDR) {

                        ////maka perbaharui bobot awal dnegan panggil model bobot awal perbaharui pada Dc /indeks 0
                        $newBobotawal = BobotAwal::find($hasilpelatihan[0]->bobotawal_id);

                        //rumus update bobot setiap kolom. data jk bobot lama - a * (ddata jk latih lama - data jk bbot lama)
                        $newjk = $newBobotawal->jk + $dEpsilon * $dLearningRate * ($rownormalisasi->jk - $newBobotawal->jk);
                        $newsemester = $newBobotawal->semester + $dEpsilon * $dLearningRate * ($rownormalisasi->semester - $newBobotawal->semester);
                        $newx1 = $newBobotawal->x1 + $dEpsilon * $dLearningRate * ($rownormalisasi->x1 - $newBobotawal->x1);
                        $newx2 = $newBobotawal->x2 + $dEpsilon * $dLearningRate * ($rownormalisasi->x2 - $newBobotawal->x2);
                        $newx3 = $newBobotawal->x3 + $dEpsilon * $dLearningRate * ($rownormalisasi->x3 - $newBobotawal->x3);
                        $newx4 = $newBobotawal->x4 + $dEpsilon * $dLearningRate * ($rownormalisasi->x4 - $newBobotawal->x4);
                        $newx5 = $newBobotawal->x5 + $dEpsilon * $dLearningRate * ($rownormalisasi->x5 - $newBobotawal->x5);
                        $newx6 = $newBobotawal->x6 + $dEpsilon * $dLearningRate * ($rownormalisasi->x6 - $newBobotawal->x6);
                        $newx7 = $newBobotawal->x7 + $dEpsilon * $dLearningRate * ($rownormalisasi->x7 - $newBobotawal->x7);
                        $newx8 = $newBobotawal->x8 + $dEpsilon * $dLearningRate * ($rownormalisasi->x8 - $newBobotawal->x8);
                        $newx9 = $newBobotawal->x9 + $dEpsilon * $dLearningRate * ($rownormalisasi->x9 - $newBobotawal->x9);
                        $newkelas = $newBobotawal->kelas + $dEpsilon * $dLearningRate * ($rownormalisasi->kelas - $newBobotawal->kelas);
                        // dd($newBobotawal->jk);

                        //update data bobot awal setipa kolom Dc dengan mengambil 2 angka dibelakang koma
                        $newBobotawal->update([
                            'jk' => number_format($newjk, 2),
                            'semester' => number_format($newsemester, 2),
                            'x1' => number_format($newx1, 2),
                            'x2' => number_format($newx2, 2),
                            'x3' => number_format($newx3, 2),
                            'x4' => number_format($newx4, 2),
                            'x5' => number_format($newx5, 2),
                            'x6' => number_format($newx6, 2),
                            'x7' => number_format($newx7, 2),
                            'x8' => number_format($newx8, 2),
                            'x9' => number_format($newx9, 2),
                            'kelas' => number_format($newkelas, 2),
                        ]);


                        //maka perbaharui bobot awal dnegan panggil model bobot awal perbaharui pada Dr /indeks 1
                        $newBobotawal1 = BobotAwal::find($hasilpelatihan[1]->bobotawal_id);

                        //rumus update bobot setiap kolom. data jk bobot lama - a * (ddata jk latih lama - data jk bbot lama)
                        $newjk = $newBobotawal1->jk + $dEpsilon * $dLearningRate * ($rownormalisasi->jk - $newBobotawal1->jk);
                        $newsemester = $newBobotawal1->semester + $dEpsilon * $dLearningRate * ($rownormalisasi->semester - $newBobotawal1->semester);
                        $newx1 = $newBobotawal1->x1 + $dEpsilon * $dLearningRate * ($rownormalisasi->x1 - $newBobotawal1->x1);
                        $newx2 = $newBobotawal1->x2 + $dEpsilon * $dLearningRate * ($rownormalisasi->x2 - $newBobotawal1->x2);
                        $newx3 = $newBobotawal1->x3 + $dEpsilon * $dLearningRate * ($rownormalisasi->x3 - $newBobotawal1->x3);
                        $newx4 = $newBobotawal1->x4 + $dEpsilon * $dLearningRate * ($rownormalisasi->x4 - $newBobotawal1->x4);
                        $newx5 = $newBobotawal1->x5 + $dEpsilon * $dLearningRate * ($rownormalisasi->x5 - $newBobotawal1->x5);
                        $newx6 = $newBobotawal1->x6 + $dEpsilon * $dLearningRate * ($rownormalisasi->x6 - $newBobotawal1->x6);
                        $newx7 = $newBobotawal1->x7 + $dEpsilon * $dLearningRate * ($rownormalisasi->x7 - $newBobotawal1->x7);
                        $newx8 = $newBobotawal1->x8 + $dEpsilon * $dLearningRate * ($rownormalisasi->x8 - $newBobotawal1->x8);
                        $newx9 = $newBobotawal1->x9 + $dEpsilon * $dLearningRate * ($rownormalisasi->x9 - $newBobotawal1->x9);
                        $newkelas = $newBobotawal1->kelas + $dEpsilon * $dLearningRate * ($rownormalisasi->kelas - $newBobotawal1->kelas);
                        // dd($newBobotawal1->jk);

                        //update data bobot awal setipa kolom Dr dengan mengambil 2 angka dibelakang koma
                        $newBobotawal1->update([
                            'jk' => number_format($newjk, 2),
                            'semester' => number_format($newsemester, 2),
                            'x1' => number_format($newx1, 2),
                            'x2' => number_format($newx2, 2),
                            'x3' => number_format($newx3, 2),
                            'x4' => number_format($newx4, 2),
                            'x5' => number_format($newx5, 2),
                            'x6' => number_format($newx6, 2),
                            'x7' => number_format($newx7, 2),
                            'x8' => number_format($newx8, 2),
                            'x9' => number_format($newx9, 2),
                            'kelas' => number_format($newkelas, 2),
                        ]);
                    }
                }
            }

            //pengurangan learning rate
            $dLearningRate = $dLearningRate - ($dPengurangan * $dLearningRate);

            //pertambahan epoch
            $dEpoch = $dEpoch + 1;
        }

        //kembli/pergi ke link bobot awal dengan pesan pelatihan berhasil dilakukan
        return redirect('/bobotawal')->with('sukses', 'Pelatihan berhasil dilakukan');
    }
}
