<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingVisitorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meeting_visitor', function(Blueprint $table)
		{$table->engine = 'MyISAM';
			$table->integer('visitor_idVisitor')->index('fk_Visitor_has_Meeting_Visitor1_idx');
			$table->integer('meeting_idMeeting')->index('fk_Visitor_has_Meeting_Meeting1_idx');
			$table->primary(['visitor_idVisitor','meeting_idMeeting']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meeting_visitor');
	}

}
