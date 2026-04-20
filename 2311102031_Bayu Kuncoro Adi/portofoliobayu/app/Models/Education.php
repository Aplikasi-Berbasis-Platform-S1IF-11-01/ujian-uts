<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // Ini jurus paksa biar Laravel ngebaca tabel yang pakai 's'
    protected $table = 'educations';

    protected $fillable = ['institusi', 'jurusan', 'tahun'];
}