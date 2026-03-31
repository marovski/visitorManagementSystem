<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToDelivertypeTable extends Migration
{
    public function up()
    {
        Schema::table('delivertype', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idDeliverType');
            $table->index('organization_id', 'delivertype_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('delivertype', function (Blueprint $table) {
            $table->dropIndex('delivertype_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
