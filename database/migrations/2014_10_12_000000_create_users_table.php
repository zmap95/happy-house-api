<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('invite_code')->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token')->unique()->nullable();
            $table->enum('status', ['inactive', 'active', 'wait_active'])->default('wait_active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
