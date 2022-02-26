<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHousesTable.
 */
class CreateHousesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('houses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id');
            $table->integer('type_id');
            $table->string('address');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('commune_id');
            $table->enum('common_fee', ['all_room', 'separate']);
            $table->decimal('electricity_per_kwh', 8, 2)->nullable();
            $table->decimal('water_per_block', 8, 2)->nullable();
            $table->integer('electricity_closing_date');
            $table->integer('water_closing_date');
            $table->enum('public_community_status', ['visible', 'invisible'])->default('visible');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('description')->nullable();
            $table->integer('user_id');
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
		Schema::drop('houses');
	}
}
