<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'duration' => $this->duration,
            'release_date' => $this->release_date,
            'category' => new CategoryResource(Category::find($this->category_id)),
            'director' => new DirectorResource(Director::find($this->director_id)),
        ];
    }
}
