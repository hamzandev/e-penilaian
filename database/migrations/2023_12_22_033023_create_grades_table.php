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
        // grades adalah nilai yang diberikan kepada siswa berdasarkan mapel
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('teacher_id');
            $table->integer('subject_id');
            $table->double('value');
            $table->double('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};

