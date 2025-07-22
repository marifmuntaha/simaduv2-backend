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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
