<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id');
            $table->string('username')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('occupation_type', ['student', 'employee', 'business', 'other'])->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
