<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAwal extends Model
{
    use HasFactory;

    //inisialisasi nama tabel dan atribut tabel
    protected $table = 'dataawal';
    protected $fillable = ['nama', 'jk', 'semester', 'x1', 'x2', 'x3', 'x4', 'x5', 'x6', 'x7', 'x8', 'x9', 'total', 'kelas'];
}
