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
        Schema::create('behavior_values', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->enum('predicate', ['A','B', 'C', 'D', 'E']);
            $table->string('behavior_type');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('behavior_values');
    }
};
