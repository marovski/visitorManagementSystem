<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'organization_id', 'plan_id', 'stripe_subscription_id',
        'stripe_invoice_id', 'status', 'amount', 'currency',
        'billing_cycle', 'starts_at', 'ends_at', 'canceled_at',
    ];

    protected $dates = ['starts_at', 'ends_at', 'canceled_at'];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }
}
