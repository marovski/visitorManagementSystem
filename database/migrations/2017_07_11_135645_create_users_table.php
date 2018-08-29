<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('idUser', true);
			$table->string('username', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('department', 45);
			$table->string('photo', 60);
			$table->integer('fk_idSecurity')->index('fk_User_Security1_idx');
			$table->string('remember_token', 100);
			$table->timestamps();
			$table->primary(['idUser','fk_idSecurity']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
