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

    public function hall_seats()
    {
        return $this->hasMany(HallSeat::class);
    }

    public function hall_sessions()
    {
        return $this->hasMany(HallSession::class);
    }
}
