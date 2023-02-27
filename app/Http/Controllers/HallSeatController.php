<?php

namespace App\Http\Controllers;

use App\Http\Resources\HallSeatResource;
use App\Models\HallSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class HallSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $hall_seats = HallSeat::all();

        if (!$hall_seats) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return HallSeatResource::collection($hall_seats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'seat_number' => 'required|integer',
            'is_empty' => 'required|boolean',
            'center_hall_id' => 'required|exist:center_halls,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $hall_seat = new HallSeat();
        $hall_seat->seat_number = $request->seat_number;
        $hall_seat->is_empty = $request->is_empty;
        $hall_seat->center_hall_id = $request->center_hall_id;
        $hall_seat->save();

        if (!$hall_seat) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'hall_seat' => new HallSeatResource($hall_seat)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HallSeat $hall_seat): Response
    {
        if (!$hall_seat) {
            return response()->json([
                'message' => 'hall_seat not found'
            ]);
        }
        return response()->json([
            'hall_seat' => new HallSeatResource($hall_seat)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HallSeat $hall_seat): Response
    {
        $validator = Validator::make($request->all(), [
            'seat_number' => 'required|integer',
            'is_empty' => 'required|boolean',
            'center_hall_id' => 'required|exist:center_halls,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $seat_number = $request->seat_number;
        $is_empty = $request->is_empty;
        $center_hall_id = $request->center_hall_id;

        $hall_seat = $hall_seat->update([
            "seat_number" => $seat_number,
            "is_empty" => $is_empty,
            "center_hall_id" => $center_hall_id,
        ]);

        if (!$hall_seat) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'hall_seat' => new HallSeatResource($hall_seat)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HallSeat $hall_seat): Response
    {
        $hall_seat->delete();

        return response()->json([
            'message' => 'hall_seat deleted'
        ]);
    }
}
