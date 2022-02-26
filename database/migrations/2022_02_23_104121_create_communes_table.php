<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCommunesTable.
 */
class CreateCommunesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('communes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('division_type');
            $table->string('codename');
            $table->integer('district_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('communes');
	}
}
