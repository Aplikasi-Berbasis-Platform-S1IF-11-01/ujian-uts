<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations'; // tambahkan baris ini
    protected $fillable = [
        'school', 'institution', 'year_start',
        'year_end', 'description', 'order'
    ];
}