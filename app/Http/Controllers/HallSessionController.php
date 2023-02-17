<?php

namespace App\Http\Controllers;

use App\Models\HallSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HallSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $hall_sessions = HallSession::all();

        return response()->json([
            'hall_sessions' => $hall_sessions
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
    public function destroy(HallSession $hall_session): Response
    {
        $hall_session->delete();

        return response()->json([
            'message' => 'hall_session deleted'
        ]);
    }
}
