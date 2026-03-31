<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToLostitemsTable extends Migration
{
    public function up()
    {
        Schema::table('lostitems', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idLostFound');
            $table->index('organization_id', 'lostitems_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('lostitems', function (Blueprint $table) {
            $table->dropIndex('lostitems_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
