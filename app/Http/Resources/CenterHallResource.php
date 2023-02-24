<?php

namespace App\Http\Resources;

use App\Models\MovieCenter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CenterHallResource extends JsonResource
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
            'hall_number' => $this->hall_number,
            'seats_count' => $this->seats_count,
            'movie_center' => new MovieCenterResource(MovieCenter::find($this->movie_center_id))
        ];
    }
}
