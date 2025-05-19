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
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('exam_hall');
            $table->foreignId('hall_id')->after('subject_id')->constrained('exam_halls')->onDelete('cascade'); // Ново поле
            $table->dateTime('start_time')->after('hall_id')->nullable(); // Добавяне на начало на изпита
            $table->dateTime('end_time')->after('start_time')-> nullable(); // Добавяне на крайно време
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('hall_id');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
};
