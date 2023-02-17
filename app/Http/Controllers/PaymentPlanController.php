<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $payment_plans = PaymentPlan::all();

        return response()->json([
            'payment_plans' => $payment_plans
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
    public function destroy(PaymentPlan $payment_plan): Response
    {
        $payment_plan->delete();

        return response()->json([
            'message' => 'payment_plan deleted'
        ]);
    }
}
