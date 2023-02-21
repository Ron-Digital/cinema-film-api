<?php

namespace App\Http\Resources;

use App\Models\CenterHall;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HallSeatResource extends JsonResource
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
            'seat_number' => $this->seat_number,
            'is_empty' => $this->is_empty,
            'center_hall' => new CenterHallResource(CenterHall::find($this->center_hall_id))
        ];
    }
}
