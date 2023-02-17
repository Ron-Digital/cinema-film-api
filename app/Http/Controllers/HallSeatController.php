<?php

namespace App\Http\Controllers;

use App\Models\HallSeat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HallSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $hall_seats = HallSeat::all();

        return response()->json([
            'hall_seats' => $hall_seats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): Response
    {
        //
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
