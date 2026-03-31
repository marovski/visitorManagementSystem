<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToDropsTable extends Migration
{
    public function up()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idDrop');
            $table->index('organization_id', 'drops_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->dropIndex('drops_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
