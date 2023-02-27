<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'payment_plan_id',
        'is_paid'
    ];

    public function payment_plan()
    {
        return $this->hasOne(PaymentPlan::class);
    }
}
