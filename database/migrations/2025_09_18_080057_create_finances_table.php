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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institutionId');
            $table->string('codeParent')->nullable();
            $table->string('codeApp')->unique();
            $table->string('code');
            $table->string('name');
            $table->string('level');
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yearId');
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('programId');
            $table->unsignedBigInteger('accountId');
            $table->string('name');
            $table->string('alias');
            $table->string('gender');
            $table->string('boardingId');
            $table->string('repeat');
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('accounts');
    }
};
