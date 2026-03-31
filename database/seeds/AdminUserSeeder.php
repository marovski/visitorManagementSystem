<?php

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create default security role if it doesn't exist
        $securityId = DB::table('securities')->insertGetId([
            'securityType' => 'Admin',
        ]);

        // Create default organization
        $org = Organization::firstOrCreate(
            ['slug' => 'default'],
            [
                'name'                => 'Default Organization',
                'email'               => 'cardozo27cv@gmail.com',
                'subscription_status' => 'trialing',
                'trial_ends_at'       => \Carbon\Carbon::now()->addDays(14),
                'is_active'           => 1,
            ]
        );

        $password = 'Admin1234!';

        // Create or update the admin user
        $user = User::updateOrCreate(
            ['email' => 'cardozo27cv@gmail.com'],
            [
                'username'        => 'admin',
                'password'        => bcrypt($password),
                'department'      => 'Management',
                'photo'           => 'default.png',
                'remember_token'  => '',
                'fk_idSecurity'   => $securityId,
                'organization_id' => $org->id,
                'is_org_admin'    => 1,
            ]
        );

        echo "\n";
        echo "===========================================\n";
        echo "  Admin user created successfully!\n";
        echo "  Email:    cardozo27cv@gmail.com\n";
        echo "  Password: {$password}\n";
        echo "===========================================\n\n";
    }
}
