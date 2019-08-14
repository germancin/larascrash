<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interests', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->index('user_id');
            $table->bigInteger('search_id')->unsigned()->index('search_id');
			$table->integer('f_interest_id')->nullable();
			$table->string('name', 200)->nullable();
			$table->integer('audience_size')->nullable();
			$table->string('path', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('topic', 200)->nullable();
			$table->integer('disambiguation_category')->nullable();
			$table->timestamps();

            $table->foreign('user_id', 'interests_ibfk_1')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');

            $table->foreign('search_id', 'interests_ibfk_2')
                ->references('id')
                ->on('searches')
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
		Schema::drop('interests');
	}

}
