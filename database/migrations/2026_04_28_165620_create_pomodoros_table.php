<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pomodoros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('type');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->integer('actual_duration')->default(0);
            $table->integer('scheduled_duration')->default(0);
            $table->string('status');

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pomodoros');
    }
};
