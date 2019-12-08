<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitors', function(Blueprint $table)
		{$table->engine = 'MyISAM';
			$table->integer('idVisitor', true);
			$table->string('visitorName', 45);
			$table->string('visitorEmail', 45);
			$table->string('visitorCitizenCard', 12)->nullable();
			$table->string('visitorNPhone', 60)->nullable();
			$table->string('visitorCompanyName', 45)->nullable();
			$table->boolean('escorted')->nullable();
			$table->boolean('wifiAcess')->nullable();
			$table->smallInteger('visitorCitizenCardType')->nullable();
			$table->boolean('visitorDangerousGood')->nullable();
			$table->string('visitorDeclaredGood', 45)->nullable();
			$table->boolean('signOutFlag')->default(0);
			$table->time('exitTime')->nullable();
			$table->time('entryTime')->nullable();
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
		Schema::drop('visitors');
	}

}
