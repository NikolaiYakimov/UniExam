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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_user_id_foreign');
            $table->dropColumn('user_id');
            $table->foreignId('student_id')->after('id')->constrained('students')->onDelete('cascade');

        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
