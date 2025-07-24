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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('UserId');
            $table->string('nisn')->unique();
            $table->string('nism')->unique();
            $table->string('nama');
            $table->enum('gender', ['L', 'P']);
            $table->string('birthplace');
            $table->date('birthdate');
            $table->timestamps();
        });

        Schema::create('student_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studentId')->nullable();
            $table->unsignedBigInteger('yearId')->nullable();
            $table->unsignedBigInteger('institutionId')->nullable();
            $table->unsignedBigInteger('rombelId')->nullable();
            $table->unsignedBigInteger('boardingId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
