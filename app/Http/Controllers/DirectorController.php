<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $directors = Director::all();

        if (!$directors) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return DirectorResource::collection($directors);
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

        $director= new Director();
        $director->name = $request->name;
        $director->age = $request->age;
        $director->save();

        if (!$director) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'director' => new DirectorResource($director)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Director $director): Response
    {
        if (!$director) {
            return response()->json([
                'message' => 'director not found'
            ]);
        }
        return response()->json([
            'director' => new DirectorResource($director)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Director $director): Response
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

        $director = $director->update([
            "name"=>$name,
            "age"=>$age,
        ]);

        if(!$director){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'director' => new DirectorResource($director)
        ]);
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
