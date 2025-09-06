<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Modules\Language\App\Models\Language;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('status')->default('active');
            $table->string('default')->default('0');
            $table->string('language_direction')->default('left_to_right');
            $table->timestamps();
        });

        if(!Language::where('code', 'en')->exists() && !Language::first()) {
            Language::create([
                'name' => 'English',
                'code' => 'en',
                'status' => 'active',
                'default' => '1',
                'language_direction' => 'left_to_right',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
