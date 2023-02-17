<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallSession extends Model
{
    use HasFactory;

    protected $table = 'hall_sessions';

    protected $fillable = [
        'show_time',
        'center_hall_id'
    ];
}
