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
        Schema::create('mail_contents', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('from');
            $table->string('subject');
            $table->datetime('mailrecvdate')->nullable();
            $table->string('body');
            $table->boolean('is_process')->default(0);
            $table->string('OpenAIemotional_status')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('userid')->default(0);;
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
