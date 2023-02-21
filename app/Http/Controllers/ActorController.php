<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $actors = Actor::all();

        if (!$actors) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return ActorResource::collection($actors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'name' => 'required',
            'age' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $actor= new Actor();
        $actor->name = $request->name;
        $actor->age = $request->age;
        $actor->save();

        if (!$actor) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'actor' => new ActorResource($actor)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor): Response
    {
        if (!$actor) {
            return response()->json([
                'message' => 'actor not found'
            ]);
        }
        return response()->json([
            'actor' => new ActorResource($actor)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor): Response
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'age' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $name=$request->name;
        $age=$request->age;

        $actor = $actor->update([
            "name"=>$name,
            "age"=>$age,
        ]);

        if(!$actor){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'actor' => new ActorResource($actor)
        ]);
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
