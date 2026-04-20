<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioProfile extends Model
{
    protected $table = 'portfolio_profile';

    protected $fillable = [
        'nama', 'tagline', 'deskripsi', 'email', 'github', 'instagram', 'foto',
    ];
}
