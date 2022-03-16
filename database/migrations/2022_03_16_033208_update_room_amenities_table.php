<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_amenities', function (Blueprint $table) {
            $table->dropColumn('house_utility_id');
            $table->string('name');
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_amenities', function (Blueprint $table) {
            $table->unsignedInteger('house_utility_id');
            $table->dropColumn('name');
            $table->dropColumn('icon');
        });
    }
}
