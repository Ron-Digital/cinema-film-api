<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $actors = Actor::all();

        return response()->json([
            'actors' => $actors
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
    public function destroy(Actor $actor): Response
    {
        $actor->delete();

        return response()->json([
            'message' => 'actor deleted'
        ]);
    }
}
