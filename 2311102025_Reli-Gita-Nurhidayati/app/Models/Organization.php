<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name', 'role', 'year_start',
        'year_end', 'description'
    ];
}