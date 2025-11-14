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
        Schema::create('admin_team_permission_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Unique permission identifier');
            $table->string('display_name')->comment('Human-readable permission name');
            $table->string('module')->comment('Functional module grouping');
            $table->text('description')->nullable()->comment('Permission description');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Parent permission ID for hierarchical structure');
            $table->boolean('is_group')->default(false)->comment('Whether this is a group permission');
            $table->string('status')->default('active')->comment('Permission status');
            $table->timestamps();

            // Foreign key for parent permission
            $table->foreign('parent_id')->references('id')->on('admin_team_permission_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_team_permission_lists');
    }
};
