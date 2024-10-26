<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('username')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone');
            $table->string('city');
            $table->string('asal_sekolah')->nullable();

            $table->uuid('university_main_id')->nullable();
            $table->uuid('university_second_id')->nullable();
            $table->uuid('faculty_main_id')->nullable();
            $table->uuid('faculty_second_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_main_id')->references('id')->on('universities')->onDelete('set null');
            $table->foreign('university_second_id')->references('id')->on('universities')->onDelete('set null');
            $table->foreign('faculty_main_id')->references('id')->on('faculties')->onDelete('set null');
            $table->foreign('faculty_second_id')->references('id')->on('faculties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('students');
    }
};
