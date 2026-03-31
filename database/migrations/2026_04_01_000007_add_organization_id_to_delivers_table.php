<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToDeliversTable extends Migration
{
    public function up()
    {
        Schema::table('delivers', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idDeliver');
            $table->index('organization_id', 'delivers_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('delivers', function (Blueprint $table) {
            $table->dropIndex('delivers_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
