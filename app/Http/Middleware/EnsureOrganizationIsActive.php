<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Organization;
use Session;

class EnsureOrganizationIsActive
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user->organization_id) {
            Auth::logout();
            Session::flash('danger', 'Your account is not linked to an organization. Please contact support.');
            return redirect()->route('login');
        }

        $org = Organization::find($user->organization_id);

        if (!$org || !$org->is_active) {
            Auth::logout();
            return redirect()->route('login')
                ->with('danger', 'Your organization account has been suspended. Please contact support.');
        }

        if (!$org->hasActiveSubscription()) {
            // Allow billing and logout routes through even when subscription is inactive
            $allowedRoutes = ['billing.show', 'billing.subscribe', 'billing.update-plan', 'billing.payment', 'billing.cancel', 'logout'];
            $currentRoute = $request->route() ? $request->route()->getName() : null;

            if (!in_array($currentRoute, $allowedRoutes) && !$request->is('admin/billing*')) {
                return redirect()->route('billing.show')
                    ->with('warning', 'Your subscription requires attention. Please update your billing information.');
            }
        }

        // Bind the current org to the app container for easy access in controllers/views
        app()->instance('currentOrganization', $org);

        return $next($request);
    }
}
