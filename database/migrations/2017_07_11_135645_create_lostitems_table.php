<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLostitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lostitems', function(Blueprint $table)
		{
			$table->integer('idLostFound', true);
			$table->integer('idUser')->index('fk_user_has_reported_lostFound');
			$table->integer('itemCategory');
			$table->string('itemDescription', 50)->nullable();
			$table->string('itemSize', 60)->nullable();
			$table->boolean('itemImportance')->nullable();
			$table->dateTime('claimedDate')->nullable();
			$table->dateTime('foundDate');
			$table->string('finderName', 40);
			$table->string('receiverName', 60)->nullable();
			$table->string('receiverPhone', 60)->nullable();
			$table->string('finderPhone', 60);
			$table->string('photo', 40)->nullable();
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
		Schema::drop('lostitems');
	}

}
