<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idUser');
            $table->string('password', 255)->nullable()->after('email');
            $table->tinyInteger('is_org_admin')->default(0)->after('password');
            $table->index('organization_id', 'users_organization_id_idx');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_organization_id_idx');
            $table->dropColumn(['organization_id', 'password', 'is_org_admin']);
        });
    }
}
