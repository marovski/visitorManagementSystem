<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDelivertypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivertype', function(Blueprint $table)
		{
			$table->foreign('deliver_idDeliver', 'fk_deliver_deliverType')->references('idDeliver')->on('delivers')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delivertype', function(Blueprint $table)
		{
			$table->dropForeign('fk_deliver_deliverType');
		});
	}

}
