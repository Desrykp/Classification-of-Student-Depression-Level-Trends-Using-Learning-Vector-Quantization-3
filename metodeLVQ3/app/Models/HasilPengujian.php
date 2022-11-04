<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPengujian extends Model
{
    use HasFactory;

    //inisialisasi nama an atribut tabel
    protected $table = 'hasilpengujian';
    protected $fillable = ['data_ke', 'kelas_data_uji', 'kelas_lvq3', 'keterangan'];
}
