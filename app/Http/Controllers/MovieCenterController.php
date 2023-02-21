<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCenterResource;
use App\Models\MovieCenter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MovieCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $movie_centers = MovieCenter::all();

        if (!$movie_centers) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return MovieCenterResource::collection($movie_centers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'name' => 'required',
            'city' => 'required',
            'how_many_halls' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $movie_center= new MovieCenter();
        $movie_center->name = $request->name;
        $movie_center->city = $request->city;
        $movie_center->how_many_halls = $request->how_many_halls;
        $movie_center->save();

        if (!$movie_center) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'movie_center' => new MovieCenterResource($movie_center)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieCenter $movie_center): Response
    {
        if (!$movie_center) {
            return response()->json([
                'message' => 'movie_center not found'
            ]);
        }
        return response()->json([
            'movie_center' => new MovieCenterResource($movie_center)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieCenter $movie_center): Response
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'city' => 'required',
            'how_many_halls' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $name=$request->name;
        $city=$request->city;
        $how_many_halls=$request->how_many_halls;

        $movie_center = $movie_center->update([
            "name"=>$name,
            "city"=>$city,
            "how_many_halls"=>$how_many_halls,
        ]);

        if(!$movie_center){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'movie_center' => new MovieCenterResource($movie_center)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieCenter $movie_center): Response
    {
        $movie_center->delete();

        return response()->json([
            'message' => 'movie_center deleted'
        ]);
    }
}
