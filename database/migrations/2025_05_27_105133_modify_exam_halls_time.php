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
        Schema::table('exam_halls', function (Blueprint $table) {
            $table->time('closing_time')->default('19:10:00')->change();
            $table->time('opening_time')->default('06:50:00')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_halls', function (Blueprint $table) {
            $table->time('closing_time')->default('20:00:00')->change();
        });
    }
};
