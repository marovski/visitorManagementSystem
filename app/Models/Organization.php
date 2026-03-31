<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Organization extends Model
{
    use SoftDeletes;

    protected $table = 'organizations';

    protected $fillable = [
        'name', 'slug', 'email', 'phone', 'address', 'logo',
        'plan_id', 'stripe_customer_id', 'stripe_subscription_id',
        'subscription_status', 'trial_ends_at', 'billing_cycle',
        'current_period_start', 'current_period_end', 'is_active', 'settings',
    ];

    protected $dates = [
        'trial_ends_at',
        'current_period_start',
        'current_period_end',
        'deleted_at',
    ];

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'organization_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription', 'organization_id');
    }

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor', 'organization_id');
    }

    public function meetings()
    {
        return $this->hasMany('App\Models\Meeting', 'organization_id');
    }

    public function delivers()
    {
        return $this->hasMany('App\Models\Deliver', 'organization_id');
    }

    public function drops()
    {
        return $this->hasMany('App\Models\Drop', 'organization_id');
    }

    public function lostItems()
    {
        return $this->hasMany('App\Models\LostFound', 'organization_id');
    }

    public function isOnTrial()
    {
        return $this->subscription_status === 'trialing'
            && $this->trial_ends_at
            && $this->trial_ends_at->isFuture();
    }

    public function hasActiveSubscription()
    {
        return in_array($this->subscription_status, ['trialing', 'active']);
    }

    public function isSubscriptionPastDue()
    {
        return $this->subscription_status === 'past_due';
    }

    public function trialDaysRemaining()
    {
        if (!$this->trial_ends_at) {
            return 0;
        }
        return max(0, Carbon::now()->diffInDays($this->trial_ends_at, false));
    }
}
