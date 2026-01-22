<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public $table = 'tasks_nota';
    public $primaryKey = 'id_nota';
    public $fillable = ['id_costomer','nama_produk','jumlah','harga','total_harga'];
}
