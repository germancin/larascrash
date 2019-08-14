<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('searches', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('user_id');
			$table->string('criteria');
			$table->string('limit');
			$table->string('locale');
			$table->timestamps();

            $table->foreign('user_id', 'searches_ibfk_1')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('searches');
	}

}
