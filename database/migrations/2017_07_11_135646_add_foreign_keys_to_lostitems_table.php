<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLostitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lostitems', function(Blueprint $table)
		{
			$table->foreign('idUser', 'fk_user_has_reported_lostFound')->references('idUser')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lostitems', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_has_reported_lostFound');
		});
	}

}
