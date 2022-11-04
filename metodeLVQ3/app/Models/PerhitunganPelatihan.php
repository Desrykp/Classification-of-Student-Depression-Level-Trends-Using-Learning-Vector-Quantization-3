<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganPelatihan extends Model
{
    use HasFactory;

    //inisialisasi nama dan atribut tabel
    protected $table = 'perhitunganpelatihan';
    protected $fillable = ['no', 'bobotawal_id', 'normalisasi_id', 'hasil', 'kelas', 'inisial', 'jk', 'semester', 'x1', 'x2', 'x3', 'x4', 'x5', 'x6', 'x7', 'x8', 'x9', 'total'];
}
