<?php

namespace App\Http\Controllers;

use App\Http\Resources\HallSessionResource;
use App\Models\HallSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class HallSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $hall_sessions = HallSession::all();

        if (!$hall_sessions) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return HallSessionResource::collection($hall_sessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'show_time' => 'required',
            'center_hall_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $hall_session= new HallSession();
        $hall_session->show_time = $request->show_time;
        $hall_session->center_hall_id = $request->center_hall_id;
        $hall_session->save();

        if (!$hall_session) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'hall_session' => new HallSessionResource($hall_session)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HallSession $hall_session): Response
    {
        if (!$hall_session) {
            return response()->json([
                'message' => 'hall_session not found'
            ]);
        }
        return response()->json([
            'hall_session' => new HallSessionResource($hall_session)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HallSession $hall_session): Response
    {
        $validator = Validator::make($request->all(),[
            'show_time' => 'required',
            'center_hall_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $show_time=$request->show_time;
        $center_hall_id=$request->center_hall_id;

        $hall_session = $hall_session->update([
            "show_time"=>$show_time,
            "center_hall_id"=>$center_hall_id,
        ]);

        if(!$hall_session){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'hall_session' => new HallSessionResource($hall_session)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HallSession $hall_session): Response
    {
        $hall_session->delete();

        return response()->json([
            'message' => 'hall_session deleted'
        ]);
    }
}
