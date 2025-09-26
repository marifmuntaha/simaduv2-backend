<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->integer('ladderId');
            $table->string('name');
            $table->string('alias');
            $table->string('nsm');
            $table->string('npsn');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('logo');
            $table->timestamps();
        });

        Schema::create('institution_user', function (Blueprint $table) {
            $table->id();
            $table->integer('institutionId');
            $table->integer('userId');
        });

        Schema::create('institution_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('yearId');
            $table->integer('institutionId');
            $table->string('name');
            $table->string('alias');
            $table->timestamps();
        });

        Schema::create('institution_rombels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yearId');
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('levelId');
            $table->unsignedBigInteger('majorId');
            $table->string('name');
            $table->string('alias')->nullable();
            $table->unsignedBigInteger('teacherId');
            $table->timestamps();
        });

        Schema::create('institution_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yearId');
            $table->string('name');
            $table->string('alias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institution_rooms');
        Schema::dropIfExists('institution_rombels');
        Schema::dropIfExists('institution_programs');
        Schema::dropIfExists('institution_user');
        Schema::dropIfExists('institutions');
    }
};
