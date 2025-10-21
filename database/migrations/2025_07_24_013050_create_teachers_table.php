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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('name');
            $table->string('pegId');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->enum('gender', ['L', 'P']);
            $table->string('frontTitle')->nullable();
            $table->string('backTitle')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
        Schema::create('teacher_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yearId');
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('teacherId');
            $table->enum('statusCode', [1, 2, 3, 4, 5])->comment('1. Kepala Madrasah, 2. Waka Kurikulum, 3. Waka Kesiswaan, 4. Walikelas, 5. Guru');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('teacher_activities', function (Blueprint $table) {
            $table->foreign('teacherId')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_activities', function (Blueprint $table) {
            $table->dropForeign('teacher_activities_teacherid_foreign');
        });
        Schema::dropIfExists('teacher_activities');
        Schema::dropIfExists('teachers');
    }
};
