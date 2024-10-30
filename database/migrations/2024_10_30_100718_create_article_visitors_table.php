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
        Schema::create('article_visitors', function (Blueprint $table) {
            $table->uuid('id');

            $table->string('visitor_ip');

            $table->uuid('article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_visitors');
    }
};
