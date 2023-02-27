<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $movies = Movie::all();

        if (!$movies) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'category_id' => 'required|exist:categories,id',
            'director_id' => 'required|exist:directors,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->duration = $request->duration;
        $movie->release_date = $request->release_date;
        $movie->category_id = $request->category_id;
        $movie->director_id = $request->director_id;
        $movie->save();

        if (!$movie) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'movie' => new MovieResource($movie)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): Response
    {
        if (!$movie) {
            return response()->json([
                'message' => 'movie not found'
            ]);
        }
        return response()->json([
            'movie' => new MovieResource($movie)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie): Response
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'category_id' => 'required|exist:categories,id',
            'director_id' => 'required|exist:directors,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $title = $request->title;
        $description = $request->description;
        $duration = $request->duration;
        $release_date = $request->release_date;
        $category_id = $request->category_id;
        $director_id = $request->director_id;

        $movie = $movie->update([
            "title" => $title,
            "description" => $description,
            "duration" => $duration,
            "release_date" => $release_date,
            "category_id" => $category_id,
            "director_id" => $director_id,
        ]);

        if (!$movie) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'movie' => new MovieResource($movie)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): Response
    {
        $movie->delete();

        return response()->json([
            'message' => 'movie deleted'
        ]);
    }
}
