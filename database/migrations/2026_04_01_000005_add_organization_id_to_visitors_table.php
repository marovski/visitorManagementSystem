<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idVisitor');
            $table->index('organization_id', 'visitors_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex('visitors_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
