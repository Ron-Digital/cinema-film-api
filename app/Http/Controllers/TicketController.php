<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $tickets = Ticket::all();

        if (!$tickets) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'user_id' => 'required',
            'movie_id' => 'required',
            'movie_center_id' => 'required',
            'center_hall_id' => 'required',
            'hall_seat_id' => 'required',
            'hall_session_id' => 'required',
            'payment_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $ticket= new Ticket();
        $ticket->user_id = $request->user_id;
        $ticket->movie_id = $request->movie_id;
        $ticket->movie_center_id = $request->movie_center_id;
        $ticket->center_hall_id = $request->center_hall_id;
        $ticket->hall_seat_id = $request->hall_seat_id;
        $ticket->hall_session_id = $request->hall_session_id;
        $ticket->payment_id = $request->payment_id;
        $ticket->save();

        if (!$ticket) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'ticket' => new TicketResource($ticket)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): Response
    {
        if (!$ticket) {
            return response()->json([
                'message' => 'ticket not found'
            ]);
        }
        return response()->json([
            'ticket' => new TicketResource($ticket)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket): Response
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'movie_id' => 'required',
            'movie_center_id' => 'required',
            'center_hall_id' => 'required',
            'hall_seat_id' => 'required',
            'hall_session_id' => 'required',
            'payment_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $user_id=$request->user_id;
        $movie_id=$request->movie_id;
        $movie_center_id=$request->movie_center_id;
        $center_hall_id=$request->center_hall_id;
        $hall_seat_id=$request->hall_seat_id;
        $hall_session_id=$request->hall_session_id;
        $payment_id=$request->payment_id;

        $ticket = $ticket->update([
            "user_id"=>$user_id,
            "movie_id"=>$movie_id,
            "movie_center_id"=>$movie_center_id,
            "center_hall_id"=>$center_hall_id,
            "hall_seat_id"=>$hall_seat_id,
            "hall_session_id"=>$hall_session_id,
            "payment_id"=>$payment_id,
        ]);

        if(!$ticket){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'ticket' => new TicketResource($ticket)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): Response
    {
        $ticket->delete();

        return response()->json([
            'message' => 'ticket deleted'
        ]);
    }
}
