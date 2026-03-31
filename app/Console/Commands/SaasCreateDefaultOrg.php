<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Organization;
use App\Models\Plan;
use DB;

class SaasCreateDefaultOrg extends Command
{
    protected $signature = 'saas:create-default-org';
    protected $description = 'Create a default organization and assign all existing users to it (run once after migrations)';

    public function handle()
    {
        $starterPlan = Plan::where('slug', 'starter')->first();

        if (!$starterPlan) {
            $this->error('No plans found. Run migrations first.');
            return 1;
        }

        $existing = Organization::where('slug', 'default-org')->first();

        if ($existing) {
            $this->info('Default organization already exists (id=' . $existing->id . ').');
            $orgId = $existing->id;
        } else {
            $org = Organization::create([
                'name'                => 'Default Organization',
                'slug'                => 'default-org',
                'email'               => 'admin@default-org.local',
                'plan_id'             => $starterPlan->id,
                'subscription_status' => 'active',
                'trial_ends_at'       => null,
                'billing_cycle'       => 'monthly',
                'is_active'           => 1,
            ]);

            $this->info('Created default organization (id=' . $org->id . ').');
            $orgId = $org->id;
        }

        // Assign all users without an organization to the default org
        $updated = DB::table('users')
            ->whereNull('organization_id')
            ->update(['organization_id' => $orgId]);

        $this->info("Assigned {$updated} user(s) to organization id={$orgId}.");

        // Assign existing data rows to the default org
        $tables = [
            'visitors'    => 'idVisitor',
            'meetings'    => 'idMeeting',
            'delivers'    => 'idDeliver',
            'delivertype' => 'idDeliverType',
            'drops'       => 'idDrop',
            'lostitems'   => 'idLostFound',
        ];

        foreach ($tables as $table => $pk) {
            $count = DB::table($table)->whereNull('organization_id')->update(['organization_id' => $orgId]);
            $this->info("  {$table}: assigned {$count} rows.");
        }

        // Pivot tables
        foreach (['meeting_user', 'meeting_visitor'] as $pivot) {
            $count = DB::table($pivot)->whereNull('organization_id')->update(['organization_id' => $orgId]);
            $this->info("  {$pivot}: assigned {$count} rows.");
        }

        $this->info('Done. All existing data is now scoped to the default organization.');
        return 0;
    }
}
