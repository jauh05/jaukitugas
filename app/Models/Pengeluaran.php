<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    public $table = 'pengeluaran';
    public $primaryKey = 'id_pengeluaran';
    public $fillable = ['tanggal', 'keterangan', 'nominal'];
}

