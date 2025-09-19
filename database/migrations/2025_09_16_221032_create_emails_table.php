<?php

use App\Models\Admin\Email;
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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('mail_host');
            $table->string('email');
            $table->string('smtp_user_name');
            $table->string('smtp_password');
            $table->string('smtp_port');
            $table->string('mail_encryption');
            $table->timestamps();
        });

        Email::create([
            'sender_name' => 'Doccure',
            'mail_host' => 'smtp.mailtrap.io',
            'email' => 'KbPZI@example.com',
            'smtp_user_name' => 'c4b5fd',
            'smtp_password' => 'c4b5fd',
            'smtp_port' => '2525',
            'mail_encryption' => 'tls',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
