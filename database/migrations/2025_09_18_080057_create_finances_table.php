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
            $table->unsignedBigInteger('parent')->nullable();
            $table->string('code');
            $table->string('codeApp');
            $table->string('name');
            $table->string('level');
            $table->string('shown');
            $table->string('type');
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('accountAppId');
            $table->unsignedBigInteger('accountRevId');
            $table->string('name');
            $table->string('alias');
            $table->string('repeat');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('accountAppId');
            $table->unsignedBigInteger('accountRevId');
            $table->string('code');
            $table->string('number');
            $table->string('name');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('items');
        Schema::dropIfExists('accounts');
    }
};
