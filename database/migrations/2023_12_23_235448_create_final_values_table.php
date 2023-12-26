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
        Schema::create('final_values', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->float('knowledge');
            $table->float('ability');
            $table->float('pts');
            $table->float('pas');
            $table->float('average');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_values');
    }
};
