<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meetings', function(Blueprint $table)
		{$table->engine = 'MyISAM';
			$table->integer('idMeeting', true);
			$table->string('meetingName', 45)->nullable()->unique('meetingName_UNIQUE');
			$table->integer('meetIdHost')->index('fk_Meeting_User1_idx');
			$table->primary(['idMeeting','meetIdHost']);
			$table->string('visitReason', 200)->nullable();
			$table->dateTime('meetStartDate')->nullable();
			$table->dateTime('meetEndDate')->nullable();
			$table->boolean('meetStatus')->nullable();
			$table->boolean('confidentiality')->nullable();
			$table->integer('sensibility')->nullable();
			$table->string('room', 45)->nullable();
			$table->boolean('email')->nullable();
			$table->softDeletes();
			$table->timestamps();
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meetings');
	}

}
