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
        Schema::create('admin_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_role_id')->comment('Reference to admin role');
            $table->unsignedBigInteger('admin_team_permission_id')->comment('Reference to admin permission');
            $table->boolean('is_allowed')->default(true)->comment('Whether permission is allowed');
            $table->timestamps();

            // Foreign keys
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');
            $table->foreign('admin_team_permission_id')->references('id')->on('admin_team_permission_lists')->onDelete('cascade');

            // Unique constraint to prevent duplicate role-permission combinations
            // $table->unique(['admin_role_id', 'admin_team_permission_id']);
             $table->unique(
                ['admin_role_id', 'admin_team_permission_id'],
                'admin_role_perm_uq'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_role_permissions');
    }
};
