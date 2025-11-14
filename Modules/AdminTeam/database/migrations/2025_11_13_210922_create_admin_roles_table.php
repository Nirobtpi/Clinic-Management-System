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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Unique role identifier');
            $table->string('display_name')->comment('Human-readable role name');
            $table->text('description')->nullable()->comment('Role description');
            $table->string('status')->default('active')->comment('Role status');
            $table->boolean('is_system_role')->default(false)->comment('Whether this is a system-defined role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_roles');
    }
};
