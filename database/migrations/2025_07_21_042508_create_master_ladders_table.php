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
        Schema::create('master_ladders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->string('description')->nullable();
        });

        Schema::create('master_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('ladderId');
            $table->string('name');
            $table->string('alias');
            $table->mediumText('description')->nullable();
        });

        Schema::create('master_majors', function (Blueprint $table) {
            $table->id();
            $table->integer('ladderId');
            $table->string('name');
            $table->string('alias');
            $table->mediumText('description')->nullable();
        });

        Schema::create('master_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_years');
        Schema::dropIfExists('master_majors');
        Schema::dropIfExists('master_levels');
        Schema::dropIfExists('master_ladders');
    }
};
