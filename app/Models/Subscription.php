<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'stripe_subscription_id',
        'stripe_status',
        'stripe_plan_id',
        'current_period_start',
        'current_period_end',
        'user_id',
        'plan_id'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
