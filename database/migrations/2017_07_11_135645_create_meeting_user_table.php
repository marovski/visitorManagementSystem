<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meeting_user', function(Blueprint $table)
		{$table->engine = 'MyISAM';
			$table->integer('user_idUser')->index('fk_User_has_Meeting_User1_idx');
			$table->integer('meeting_idMeeting')->index('fk_User_has_Meeting_Meeting1_idx');
			$table->primary(['user_idUser','meeting_idMeeting']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meeting_user');
	}

}
