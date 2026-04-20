<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama', 'email', 'deskripsi', 'foto', 'no_hp', 'alamat', 'sekolah'];
}