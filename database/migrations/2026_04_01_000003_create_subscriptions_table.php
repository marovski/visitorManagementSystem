<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('plan_id');
            $table->string('stripe_subscription_id', 100)->nullable();
            $table->string('stripe_invoice_id', 100)->nullable();
            $table->string('status', 30);
            $table->decimal('amount', 8, 2)->default(0);
            $table->string('currency', 5)->default('usd');
            $table->enum('billing_cycle', ['monthly', 'annual'])->default('monthly');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
