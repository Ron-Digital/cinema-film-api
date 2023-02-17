<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $directors = Director::all();

        return response()->json([
            'directors' => $directors
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
    public function destroy(Director $director): Response
    {
        $director->delete();

        return response()->json([
            'message' => 'director deleted'
        ]);
    }
}
