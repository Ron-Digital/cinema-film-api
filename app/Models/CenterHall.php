<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHall extends Model
{
    use HasFactory;

    protected $table = 'center_halls';

    protected $fillable = [
        'hall_number',
        'seats_count',
        'movie_center_id'
    ];
}
