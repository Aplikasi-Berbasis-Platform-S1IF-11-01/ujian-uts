<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Tambahkan ini! Ini kunci agar data bisa masuk
    protected $fillable = ['nama', 'alamat', 'email', 'instagram', 'deskripsi', 'foto', 'skills'];
}