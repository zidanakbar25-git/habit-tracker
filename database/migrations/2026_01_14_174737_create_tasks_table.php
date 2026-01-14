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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
        $table->string('name');

        // schedule
        $table->enum('type', ['daily', 'weekly']);
        $table->json('days')->nullable(); 
        // contoh days: ["mon","wed","fri"]

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
