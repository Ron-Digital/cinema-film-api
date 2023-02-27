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
        'hall_seat_id',
        'hall_session_id',
        'payment_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function hall_session()
    {
        return $this->hasOne(HallSession::class);
    }

    public function hall_seat()
    {
        return $this->hasOne(HallSeat::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
