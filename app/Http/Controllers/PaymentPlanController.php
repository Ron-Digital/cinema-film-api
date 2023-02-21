<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentPlanResource;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PaymentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $payment_plans = PaymentPlan::all();

        if (!$payment_plans) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }

        return PaymentPlanResource::collection($payment_plans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $rules = [
            'title' => 'required',
            'price' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $payment_plan= new PaymentPlan();
        $payment_plan->title = $request->title;
        $payment_plan->price = $request->price;
        $payment_plan->save();

        if (!$payment_plan) {
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'payment_plan' => new PaymentPlanResource($payment_plan)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentPlan $payment_plan): Response
    {
        if (!$payment_plan) {
            return response()->json([
                'message' => 'payment_plan not found'
            ]);
        }
        return response()->json([
            'payment_plan' => new PaymentPlanResource($payment_plan)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentPlan $payment_plan): Response
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'validationMessages' => $validator->errors()
            ], 400);
        }

        $title=$request->title;
        $price=$request->price;

        $payment_plan = $payment_plan->update([
            "title"=>$title,
            "price"=>$price,
        ]);

        if(!$payment_plan){
            return response()->json([
                'message' => 'an unexpected error has occurred'
            ]);
        }
        return response()->json([
            'status' => true,
            'payment_plan' => new PaymentPlanResource($payment_plan)
        ]);
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
