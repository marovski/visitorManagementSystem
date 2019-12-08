<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivers', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';
			$table->integer('idDeliver', true);
			$table->integer('deIdUser')->index('fk_Deliver_User2_idx');
			$table->primary(['idDeliver','deIdUser']);
			$table->string('deFirmSupplier', 45)->nullable();
			$table->string('deDriverName', 45)->nullable();
			$table->integer('deDriverID');
			$table->string('vehicleRegistry', 25)->nullable();
			$table->dateTime('deEntryTime')->nullable();
			$table->dateTime('deExitTime')->nullable();
			$table->float('entryWeight', 10, 0)->nullable();
			$table->float('exitWeight', 10, 0)->nullable();
			$table->string('image', 60)->nullable();
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
		Schema::drop('delivers');
	}

}
