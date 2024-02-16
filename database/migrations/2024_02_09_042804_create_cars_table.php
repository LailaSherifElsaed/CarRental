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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoryId')->constrained('categories');
            $table->string('title');
            $table->tinyInteger('luggage');
            $table->tinyInteger('doors');
            $table->tinyInteger('passenger');
            $table->string('description', 100);
            $table->integer('price');
            $table->boolean('active');
            $table->string('image',100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
