<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organization;
use App\Models\Plan;
use Illuminate\Http\Request;
use Auth;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'org_name' => 'required|string|max:150',
            'username' => 'required|string|max:45',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $starterPlan = Plan::where('slug', 'starter')->first();

        if (!$starterPlan) {
            Session::flash('danger', 'System configuration error: no plans available. Please contact support.');
            return redirect()->back()->withInput();
        }

        // Create the organization
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $request->org_name)) . '-' . substr(uniqid(), -6);

        $org = Organization::create([
            'name'                => $request->org_name,
            'slug'                => $slug,
            'email'               => $request->email,
            'plan_id'             => $starterPlan->id,
            'subscription_status' => 'trialing',
            'trial_ends_at'       => now()->addDays(14),
            'billing_cycle'       => 'monthly',
            'is_active'           => 1,
        ]);

        // Create the admin user
        $user = User::create([
            'username'        => $request->username,
            'email'           => $request->email,
            'password'        => bcrypt($request->password),
            'organization_id' => $org->id,
            'fk_idSecurity'   => 1,
            'is_org_admin'    => 1,
            'department'      => 'Administration',
            'photo'           => 'default.png',
            'remember_token'  => str_random(10),
        ]);

        Auth::loginUsingId($user->idUser);

        Session::flash('success', 'Welcome! Your 14-day free trial has started. Please select a plan.');
        return redirect()->route('onboarding.plan');
    }
}
