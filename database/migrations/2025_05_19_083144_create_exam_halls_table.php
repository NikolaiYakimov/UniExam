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
        Schema::create('exam_halls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('capacity');
            $table->time('opening_time')->default('07:00:00');
            $table->time('closing_time')->default('19:10:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_halls');
    }
};
