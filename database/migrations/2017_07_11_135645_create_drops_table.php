<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drops', function(Blueprint $table)
		{	$table->engine = 'MyISAM';
			$table->integer('idDrop', true);
			$table->integer('dropIdUser')->index('fk_Deliver_User1_idx');
			$table->primary(['idDrop','dropIdUser']);
			$table->string('dropperName', 45);
			$table->string('dropperCompanyName', 45)->nullable();
			$table->string('dropReceiver', 45)->nullable();
			$table->dateTime('droppedWhen');
			$table->dateTime('dropReceivedDate')->nullable();
			$table->string('dropDescr', 250);
			$table->boolean('dropImportance')->nullable();
			$table->string('dropSize', 60)->nullable();
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
		Schema::drop('drops');
	}

}
