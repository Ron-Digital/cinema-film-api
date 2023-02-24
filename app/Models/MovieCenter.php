<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCenter extends Model
{
    use HasFactory;

    protected $table = 'movie_centers';

    protected $fillable = [
        'name',
        'city',
    ];
}
