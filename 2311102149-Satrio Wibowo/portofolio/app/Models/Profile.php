<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    protected $fillable = ['heading', 'description', 'skills', 'photo'];

    protected $casts = [
        'skills' => 'array',
    ];
}