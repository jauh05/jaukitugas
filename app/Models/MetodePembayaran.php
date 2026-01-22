<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    public $table = 'metode';
    public $primaryKey = 'id_metode';
    public $fillable = ['nama_metode'];
}
