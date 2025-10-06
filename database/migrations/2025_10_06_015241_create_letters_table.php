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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('type')->comment('1. Mutasi Keluar');
            $table->mediumText('data');
            $table->boolean('signature')->comment('1. digital, 2. manual');
            $table->unsignedBigInteger('creatorId');
            $table->unsignedBigInteger('updaterId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
