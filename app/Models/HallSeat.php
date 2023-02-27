<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallSeat extends Model
{
    use HasFactory;

    protected $table = 'hall_seats';

    protected $fillable = [
        'seat_number',
        'is_empty',
        'center_hall_id'
    ];

    public function center_hall()
    {
        return $this->belongsTo(CenterHall::class);
    }
}
