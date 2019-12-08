<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelivertypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivertype', function(Blueprint $table)

		{	$table->engine = 'MyISAM';
			$table->integer('idDeliverType', true);
			$table->integer('deliver_idDeliver')->index('fk_deliver_idDeliver');
			$table->string('materialDetails', 250)->nullable();
			$table->float('quantity', 10, 0)->nullable();
			$table->boolean('dangerousGood')->nullable();
			$table->boolean('sensitiveLevel')->nullable();
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
		Schema::drop('delivertype');
	}

}
