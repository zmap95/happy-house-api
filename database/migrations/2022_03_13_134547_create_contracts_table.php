<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContractsTable.
 */
class CreateContractsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contracts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('house_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reference_code_contract');
            $table->decimal('price', 8, 2);
            $table->decimal('deposit', 8, 2)->default(0);
            $table->integer('contract_period_id');
            $table->integer('collect_day');
            $table->string('customer_name');
            $table->string('customer_avatar')->nullable();
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->date('customer_dob')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('commune_id')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_id_number');
            $table->date('customer_id_number_date')->nullable();
            $table->string('customer_id_number_location')->nullable();
            $table->string('customer_id_number_font')->nullable();
            $table->string('customer_id_number_back')->nullable();
            $table->text('note')->nullable();
            $table->enum('residence_permit', ['unregistered', 'registered', 'registered_without_end_time '])->default('unregistered');
            $table->enum('status', ['temporary', 'confirmed', 'expired'])->default('temporary');

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
		Schema::drop('contracts');
	}
}
