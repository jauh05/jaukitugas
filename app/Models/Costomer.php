<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costomer extends Model
{
    public $table = "costomer";
    public $primaryKey = "id_costomer";
    public $fillable = array('nama','tanggal','waktu','total','selesaikan','id_metode','harga','jumlah');


}

