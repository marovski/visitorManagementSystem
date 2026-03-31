<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToPivotTables extends Migration
{
    public function up()
    {
        Schema::table('meeting_user', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable();
            $table->index('organization_id', 'meeting_user_organization_id_idx');
        });

        Schema::table('meeting_visitor', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable();
            $table->index('organization_id', 'meeting_visitor_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('meeting_user', function (Blueprint $table) {
            $table->dropIndex('meeting_user_organization_id_idx');
            $table->dropColumn('organization_id');
        });

        Schema::table('meeting_visitor', function (Blueprint $table) {
            $table->dropIndex('meeting_visitor_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
