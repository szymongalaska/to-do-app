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
        Schema::table('task_groups', function (Blueprint $table) {
            $table->enum('order', ['created_at.desc', 'created_at.asc', 'deadline', 'task'])->default('created_at.desc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_groups', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
