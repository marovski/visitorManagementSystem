<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMeetingUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('meeting_user', function(Blueprint $table)
		{
			$table->foreign('meeting_idMeeting', 'fk_meeting_has_user')->references('idMeeting')->on('meetings')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_idUser', 'fk_user_has_meeting')->references('idUser')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('meeting_user', function(Blueprint $table)
		{
			$table->dropForeign('fk_meeting_has_user');
			$table->dropForeign('fk_user_has_meeting');
		});
	}

}
