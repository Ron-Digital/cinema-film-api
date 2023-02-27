<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'category_id',
        'director_id'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'rs_movie_actors', 'movie_id', 'actor_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function director()
    {
        return $this->hasOne(Director::class);
    }
}
