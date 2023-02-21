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
            'how_many_seats' => $this->how_many_seats,
            'movie_center' => new MovieCenterResource(MovieCenter::find($this->movie_center_id))
        ];
    }
}
