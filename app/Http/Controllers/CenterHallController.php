<?php

namespace App\Http\Controllers;

use App\Models\CenterHall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CenterHallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $center_halls = CenterHall::all();

        return response()->json([
            'center_halls' => $center_halls
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
    public function destroy(CenterHall $center_hall): Response
    {
        $center_hall->delete();

        return response()->json([
            'message' => 'center_hall deleted'
        ]);
    }
}
