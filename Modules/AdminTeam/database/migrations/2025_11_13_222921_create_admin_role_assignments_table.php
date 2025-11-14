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
        Schema::create('admin_role_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->comment('Reference to admin user');
            $table->unsignedBigInteger('admin_role_id')->comment('Reference to admin role');
            $table->unsignedBigInteger('assigned_by')->nullable()->comment('Admin who assigned this role');
            $table->timestamp('assigned_at')->useCurrent()->comment('When role was assigned');
            $table->string('status')->default('active')->comment('Assignment status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('admins')->onDelete('set null');

            // Unique constraint to prevent duplicate admin-role combinations
            $table->unique(['admin_id', 'admin_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_role_assignments');
    }
};
