<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('task_logs', function (Blueprint $table) {
            $table->dropColumn('checked');
            $table->enum('status', ['success', 'fail'])->after('log_date');
        });
    }

    public function down(): void
    {
        Schema::table('task_logs', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->boolean('checked')->default(false);
        });
    }
};
