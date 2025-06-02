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
            $table->dropForeign('payments_student_id_foreign');
            $table->dropColumn('student_id');
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
            $table->string('stripe_payment_id')->nullable()->after('exam_id')->unique();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
