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
        Schema::create('faculty_interests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');

            $table->string('interest');

            $table->softDeletes();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_interests');
    }
};
