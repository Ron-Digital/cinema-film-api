<?php

namespace App\Http\Resources;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'is_paid' => $this->is_paid,
            'payment_plan' => new PaymentPlanResource(PaymentPlan::find($this->payment_plan_id))
        ];
    }
}
