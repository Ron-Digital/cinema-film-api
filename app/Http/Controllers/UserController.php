<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::all();

        if (!$users) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'name' => 'required|min:3',
            'age' => 'required|integer|between:10,99',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'gsm_number' => 'required|digits:10'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->gsm_number = $request->gsm_number;
        $user->save();

        if (!$user) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        if (!$user) {
            return response()->json([
                'message' => 'user not found'
            ]);
        }
        return response()->json([
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'age' => 'required|integer|between:10,99',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'gsm_number' => 'required|digits:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $name = $request->name;
        $age = $request->age;
        $email = $request->email;
        $password = $request->password;
        $gsm_number = $request->gsm_number;

        $user = $user->update([
            "name" => $name,
            "age" => $age,
            "email" => $email,
            "password" => $password,
            "gsm_number" => $gsm_number,
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        if (!$user) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return response()->json([
            'message' => 'user deleted'
        ]);
    }
}
