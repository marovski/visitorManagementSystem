<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMeetingVisitorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('meeting_visitor', function(Blueprint $table)
		{
			$table->foreign('meeting_idMeeting', 'fk_meeting_has_visitor')->references('idMeeting')->on('meetings')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('visitor_idVisitor', 'fk_visitor_has_meeting')->references('idVisitor')->on('visitors')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('meeting_visitor', function(Blueprint $table)
		{
			$table->dropForeign('fk_meeting_has_visitor');
			$table->dropForeign('fk_visitor_has_meeting');
		});
	}

}
