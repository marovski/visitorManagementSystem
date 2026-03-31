<?php

namespace App\Http\Controllers\Traits;

use Auth;

trait ScopesToOrganization
{
    protected function currentOrgId()
    {
        return Auth::user()->organization_id;
    }

    protected function orgScope($query)
    {
        return $query->where('organization_id', $this->currentOrgId());
    }
}
