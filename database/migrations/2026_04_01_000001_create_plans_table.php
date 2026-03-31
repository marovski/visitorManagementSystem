<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->string('stripe_price_id_monthly', 100)->nullable();
            $table->string('stripe_price_id_annual', 100)->nullable();
            $table->decimal('price_monthly', 8, 2)->default(0);
            $table->decimal('price_annual', 8, 2)->default(0);
            $table->smallInteger('max_users')->unsigned()->default(5)->comment('0 = unlimited');
            $table->smallInteger('max_visitors_per_month')->unsigned()->default(100)->comment('0 = unlimited');
            $table->text('features')->nullable()->comment('JSON array of feature flags');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        // Seed default plans
        DB::table('plans')->insert([
            [
                'name'                    => 'Starter',
                'slug'                    => 'starter',
                'stripe_price_id_monthly' => null,
                'stripe_price_id_annual'  => null,
                'price_monthly'           => 29.00,
                'price_annual'            => 290.00,
                'max_users'               => 5,
                'max_visitors_per_month'  => 200,
                'features'                => json_encode(['visitor_management', 'meetings', 'email_notifications']),
                'is_active'               => 1,
                'created_at'              => \Carbon\Carbon::now(),
                'updated_at'              => \Carbon\Carbon::now(),
            ],
            [
                'name'                    => 'Professional',
                'slug'                    => 'professional',
                'stripe_price_id_monthly' => null,
                'stripe_price_id_annual'  => null,
                'price_monthly'           => 79.00,
                'price_annual'            => 790.00,
                'max_users'               => 25,
                'max_visitors_per_month'  => 1000,
                'features'                => json_encode(['visitor_management', 'meetings', 'email_notifications', 'deliveries', 'drops', 'lost_found', 'analytics']),
                'is_active'               => 1,
                'created_at'              => \Carbon\Carbon::now(),
                'updated_at'              => \Carbon\Carbon::now(),
            ],
            [
                'name'                    => 'Enterprise',
                'slug'                    => 'enterprise',
                'stripe_price_id_monthly' => null,
                'stripe_price_id_annual'  => null,
                'price_monthly'           => 199.00,
                'price_annual'            => 1990.00,
                'max_users'               => 0,
                'max_visitors_per_month'  => 0,
                'features'                => json_encode(['visitor_management', 'meetings', 'email_notifications', 'deliveries', 'drops', 'lost_found', 'analytics', 'api_access', 'priority_support']),
                'is_active'               => 1,
                'created_at'              => \Carbon\Carbon::now(),
                'updated_at'              => \Carbon\Carbon::now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
