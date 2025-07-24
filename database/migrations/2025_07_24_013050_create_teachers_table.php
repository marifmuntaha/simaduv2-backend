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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pageID');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->enum('gender', ['L', 'P']);
            $table->string('frontTitle')->nullable();
            $table->string('backTitle')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('teacher_institution', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacherId');
            $table->unsignedBigInteger('institutionId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
