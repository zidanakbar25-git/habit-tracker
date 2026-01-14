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
    Schema::create('task_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('task_id')->constrained()->cascadeOnDelete();
        $table->date('log_date');
        $table->boolean('checked')->default(false);
        $table->timestamps();

        $table->unique(['task_id', 'log_date']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_logs');
    }
};
