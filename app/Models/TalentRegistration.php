<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'instagram',
        'no_wa',
        'asal_univ',
        'program_study_semester',
        'keahlian',
        'file_pdf',
        'status',
    ];

    protected $casts = [
        'keahlian' => 'array',
    ];
}
