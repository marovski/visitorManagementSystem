<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name', 'slug', 'stripe_price_id_monthly', 'stripe_price_id_annual',
        'price_monthly', 'price_annual', 'max_users', 'max_visitors_per_month',
        'features', 'is_active',
    ];

    public function organizations()
    {
        return $this->hasMany('App\Models\Organization', 'plan_id');
    }

    public function getStripePriceId($billing_cycle = 'monthly')
    {
        return $billing_cycle === 'annual'
            ? $this->stripe_price_id_annual
            : $this->stripe_price_id_monthly;
    }

    public function getFeaturesArrayAttribute()
    {
        return json_decode($this->features, true) ?? [];
    }

    public function hasFeature($feature)
    {
        return in_array($feature, $this->features_array);
    }
}
