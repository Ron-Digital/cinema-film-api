<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $payments = Payment::all();

        if (!$payments) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return PaymentResource::collection($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'payment_plan_id' => 'required|exists:payment_plans,id',
            'is_paid' => 'required|boolean'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $payment = new Payment();
        $payment->payment_plan_id = $request->payment_plan_id;
        $payment->is_paid = $request->is_paid;
        $payment->save();

        if (!$payment) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'payment' => new PaymentResource($payment)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): Response
    {
        if (!$payment) {
            return response()->json([
                'message' => 'payment not found'
            ]);
        }
        return response()->json([
            'payment' => new PaymentResource($payment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment): Response
    {
        $validator = Validator::make($request->all(), [
            'payment_plan_id' => 'required|exists:payment_plans,id',
            'is_paid' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $payment_plan_id = $request->payment_plan_id;
        $is_paid = $request->is_paid;

        $payment = $payment->update([
            "payment_plan_id" => $payment_plan_id,
            "is_paid" => $is_paid,
        ]);

        if (!$payment) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'payment' => new PaymentResource($payment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): Response
    {
        $payment->delete();

        return response()->json([
            'message' => 'payment deleted'
        ]);
    }
}
