<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $table = 'admin';
    public $primaryKey = 'id_admin';
    public $fillable = ['username','password'];
}
