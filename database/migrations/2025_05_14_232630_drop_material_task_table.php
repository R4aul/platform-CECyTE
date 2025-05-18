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
        Schema::dropIfExists('material_task');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('material_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->timestamps();
        });
    }
};
