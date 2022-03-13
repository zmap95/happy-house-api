<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFeeCategoriesTable.
 */
class CreateFeeCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unit');
            $table->enum('type', ['volatility', 'fixed'])->comment("volatility: là các chi phí biến động giá, fixed: là chi phí cố định");
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
		Schema::drop('fee_categories');
	}
}
