<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transformasi extends Model
{
    use HasFactory;

    //inisialisasi nama dan atribut tabel
    protected $table = 'transformasi';
    protected $fillable = ['no', 'jk', 'semester', 'x1', 'x2', 'x3', 'x4', 'x5', 'x6', 'x7', 'x8', 'x9', 'kelas'];
}
