<?php

namespace App\Http\Resources;

use App\Models\CenterHall;
use App\Models\HallSeat;
use App\Models\HallSession;
use App\Models\Movie;
use App\Models\MovieCenter;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'user' => new UserResource(User::find($this->user_id)),
            'hall_seat' => new HallSeatResource(HallSeat::find($this->hall_seat_id)),
            'hall_session' => new HallSessionResource(HallSession::find($this->hall_session_id)),
            'payment' => new PaymentResource(Payment::find($this->payment_id))
        ];
    }
}
