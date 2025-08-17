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
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->references('id')->cascadeOnDelete();
            $table->string('clinic_id')->nullable();

            $table->string('free')->nullable();
            $table->string('custom_price')->nullable();

            // Services and Specialization
            $table->string('services')->nullable();
            $table->string('specialization')->nullable();

            // Educaion
            $table->string('degree')->nullable();
            $table->string('collage')->nullable();
            $table->string('completion_year')->nullable();

            // Experience
            $table->string('hospital_name')->nullable();
            $table->string('experience_from')->nullable();
            $table->string('experience_to')->nullable();
            $table->string('designation')->nullable();

            // Awards
            $table->string('awards')->nullable();
            $table->string('award_year')->nullable();

            // Memberships
            $table->text('memberships')->nullable();

            // Registrations
            $table->string('registrations')->nullable();
            $table->string('registration_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};
