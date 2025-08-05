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
            $table->string('clinic_name')->nullable();
            $table->string('clinic_address')->nullable();
            $table->string('clinic_images')->nullable();

            $table->string('pricing')->nullable();

            // Services and Specialization
            $table->string('services')->nullable();
            $table->string('specialization')->nullable();

            // Educaion
            $table->string('degree')->nullable();
            $table->string('collage')->nullable();
            $table->date('completion_year')->nullable();

            // Experience
            $table->string('hospital_name')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->date('designation')->nullable();

            // Awards
            $table->string('awards')->nullable();
            $table->date('award_year')->nullable();

            // Memberships
            $table->string('memberships')->nullable();

            // Registrations
            $table->string('registrations')->nullable();
            $table->date('registration_date')->nullable();

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
