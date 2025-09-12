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
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('parentId');
            $table->string('nik')->unique();
            $table->string('nisn')->unique();
            $table->string('nism')->unique();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('userId');
            $table->string('numberKk')->unique();
            $table->string('headFamily')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('fatherNIK')->nullable();
            $table->enum('fatherStatus', [1, 2, 3])->comment('1. Hidup, 2. Meninggal, 3. Tidak Diketahui');
            $table->string('fatherBirthplace')->nullable();
            $table->string('fatherBirthdate')->nullable();
            $table->string('fatherEmail')->nullable();
            $table->string('fatherPhone')->nullable();
            $table->string('motherName')->nullable();
            $table->string('motherNIK')->nullable();
            $table->enum('motherStatus', [1, 2, 3])->comment('1. Hidup, 2. Meninggal, 3. Tidak Diketahui');
            $table->string('motherBirthplace')->nullable();
            $table->string('motherBirthdate')->nullable();
            $table->string('motherEmail')->nullable();
            $table->string('motherPhone')->nullable();
            $table->string('guardName')->nullable();
            $table->string('guardNIK')->nullable();
            $table->enum('guardStatus', [1, 2, 3])->comment('1. Sama dengan Ayah, 2. Sama dengan Ibu, 3. Lainnya');
            $table->string('guardBirthplace')->nullable();
            $table->string('guardBirthdate')->nullable();
            $table->string('guardEmail')->nullable();
            $table->string('guardPhone')->nullable();
            $table->timestamps();
        });

        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('studentId');
            $table->integer('provinceId')->nullable();
            $table->integer('cityId')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('villageId')->nullable();
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [1, 2, 3])->comment('1. Aktif, 2. Keluar, 3. Alumni');
            $table->unsignedBigInteger('studentId')->nullable();
            $table->unsignedBigInteger('yearId')->nullable();
            $table->unsignedBigInteger('institutionId')->nullable();
            $table->unsignedInteger('levelId')->nullable();
            $table->unsignedBigInteger('rombelId')->nullable();
            $table->unsignedBigInteger('programId')->nullable();
            $table->unsignedBigInteger('boardingId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activities');
        Schema::dropIfExists('student_addresses');
        Schema::dropIfExists('student_parents');
        Schema::dropIfExists('students');
    }
};
