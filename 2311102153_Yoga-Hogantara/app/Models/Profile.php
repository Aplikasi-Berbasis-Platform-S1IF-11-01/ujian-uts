<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama', 'role', 'deskripsi', 'path_foto', 'email', 'github', 'linkedin'];
}