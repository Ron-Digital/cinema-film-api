<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'movie_id',
        'movie_center_id',
        'center_hall_id',
        'hall_seat_id',
        'hall_session_id',
        'payment_id'
    ];
}
