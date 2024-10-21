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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('mentor_id');
            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('cascade');

            $table->uuid('course_category_id');
            $table->foreign('course_category_id')->references('id')->on('course_categories')->onDelete('cascade');

            $table->string('title');
            $table->text('slug');
            $table->text('description');
            $table->string('thumbnail');
            $table->string('trailer');
            $table->boolean('is_favourite')->default(false);
            $table->boolean('is_active')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
