<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    //inisialisasi nama dan atribut tabel
    protected $table = 'pelatihan';
    protected $fillable = ['learningRate', 'mina', 'window', 'epsilon', 'maxepoch', 'pengurangan'];
}
