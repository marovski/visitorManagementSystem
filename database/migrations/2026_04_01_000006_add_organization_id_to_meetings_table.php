<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdToMeetingsTable extends Migration
{
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->after('idMeeting');
            $table->index('organization_id', 'meetings_organization_id_idx');
        });

        // Drop the global unique constraint on meetingName, replace with per-org composite unique
        DB::statement('ALTER TABLE meetings DROP INDEX meetingName_UNIQUE');
        DB::statement('ALTER TABLE meetings ADD UNIQUE INDEX meetings_name_org_unique (meetingName, organization_id)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE meetings DROP INDEX meetings_name_org_unique');
        DB::statement('ALTER TABLE meetings ADD UNIQUE INDEX meetingName_UNIQUE (meetingName)');

        Schema::table('meetings', function (Blueprint $table) {
            $table->dropIndex('meetings_organization_id_idx');
            $table->dropColumn('organization_id');
        });
    }
}
