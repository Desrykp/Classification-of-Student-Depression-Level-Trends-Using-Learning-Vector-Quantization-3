<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianData extends Model
{
    use HasFactory;

    //inisialisasi nama dan atribut tabel
    protected $table = 'pembagiandata';
    protected $fillable = ['dLatih', 'dUji'];
}
