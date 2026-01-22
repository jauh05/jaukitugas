<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    public $table = "komentar"; // Nama tabel
    public $primaryKey = "id_komentar"; // Primary key
    public $fillable = array('nama','tentang','komentar','created_at','updated_at');

}
