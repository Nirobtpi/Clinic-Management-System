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
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('clinic_id')->nullable()->after('doctor_id');
            $table->decimal('fee',10,2)->nullable()->after('clinic_id');
            $table->string('payment_method')->nullable();
            $table->tinyInteger('payment_status');
            $table->tinyInteger('appointment_status');
            $table->string('transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('clinic_id');
            $table->dropColumn('fee');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
            $table->dropColumn('appointment_status');
            $table->dropColumn('transaction_id');
        });
    }
};
