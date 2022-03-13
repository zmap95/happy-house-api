<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHouseFeesTable.
 */
class CreateHouseFeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('house_fees', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('house_id');
            $table->string('name');
            $table->integer('category_id');
            $table->enum('type', ['is_default', 'addition'])->nullable();
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
		Schema::drop('house_fees');
	}
}
