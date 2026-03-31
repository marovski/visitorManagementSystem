<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 150);
            $table->string('slug', 100)->unique();
            $table->string('email', 150)->unique();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('logo', 100)->nullable();
            $table->unsignedInteger('plan_id');
            $table->string('stripe_customer_id', 100)->nullable();
            $table->string('stripe_subscription_id', 100)->nullable();
            $table->enum('subscription_status', ['trialing', 'active', 'past_due', 'canceled', 'unpaid'])->default('trialing');
            $table->timestamp('trial_ends_at')->nullable();
            $table->enum('billing_cycle', ['monthly', 'annual'])->default('monthly');
            $table->timestamp('current_period_start')->nullable();
            $table->timestamp('current_period_end')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->text('settings')->nullable()->comment('JSON org-level settings');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
