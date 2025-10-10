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
            $table->unsignedBigInteger('yearId');
            $table->unsignedBigInteger('institutionId');
            $table->string('number');
            $table->string('type')->comment('1.01. Surat Keterangan, 1.02. Surat Keterangan Aktif, 1.03. Surat Pindah Sekolah, 1.04. Surat Pindah Sekolah');
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
