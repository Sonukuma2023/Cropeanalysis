<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_name',
        'disease_name',
        'symptoms',
        'pesticide',
        'organic_solution',
        'prevention'
    ];
}
