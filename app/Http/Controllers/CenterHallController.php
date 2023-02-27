<?php

namespace App\Http\Controllers;

use App\Http\Resources\CenterHallResource;
use App\Models\CenterHall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CenterHallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $center_halls = CenterHall::all();

        if (!$center_halls) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return CenterHallResource::collection($center_halls);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'hall_number' => 'required|integer',
            'seats_count' => 'required|integer',
            'movie_center_id' => 'required|exist:movie_centers,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $center_hall= new CenterHall();
        $center_hall->hall_number = $request->hall_number;
        $center_hall->seats_count = $request->seats_count;
        $center_hall->movie_center_id = $request->movie_center_id;
        $center_hall->save();

        if (!$center_hall) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'center_hall' => new CenterHallResource($center_hall)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CenterHall $center_hall): Response
    {
        if (!$center_hall) {
            return response()->json([
                'message' => 'center_hall not found'
            ]);
        }
        return response()->json([
            'center_hall' => new CenterHallResource($center_hall)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CenterHall $center_hall): Response
    {
        $validator = Validator::make($request->all(),[
            'hall_number' => 'required|integer',
            'seats_count' => 'required|integer',
            'movie_center_id' => 'required|exist:movie_centers,id'
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $hall_number=$request->hall_number;
        $seats_count=$request->seats_count;
        $movie_center_id=$request->movie_center_id;

        $center_hall = $center_hall->update([
            "hall_number"=>$hall_number,
            "seats_count"=>$seats_count,
            "movie_center_id"=>$movie_center_id,
        ]);

        if(!$center_hall){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'center_hall' => new CenterHallResource($center_hall)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CenterHall $center_hall): Response
    {
        $center_hall->delete();

        return response()->json([
            'message' => 'center_hall deleted'
        ]);
    }
}
