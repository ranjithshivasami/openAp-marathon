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
        Schema::create('user_mail_settings', function (Blueprint $table) {
            $table->id();            
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('mail_server');
            $table->string('port');
            $table->string('protocol');
            $table->string('password');
            $table->string('mail_server');
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_mail_settings');
    }
};
