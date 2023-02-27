<?php

namespace App\Http\Resources;

use App\Models\CenterHall;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HallSessionResource extends JsonResource
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
            'show_time' => $this->show_time,
            'center_hall' => new CenterHallResource(CenterHall::find($this->center_hall_id)),
            'movie' => new MovieResource(Movie::find($this->movie_id))
        ];
    }
}
