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
            $table->unsignedBigInteger('parentId')->nullable();
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
            $table->string('provinceId')->nullable();
            $table->string('cityId')->nullable();
            $table->string('districtId')->nullable();
            $table->string('villageId')->nullable();
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [1, 2, 3, 4])->comment('1. Aktif, 2. Keluar, 3. Alumni, 4. Pindah Kelas');
            $table->unsignedBigInteger('studentId')->nullable();
            $table->unsignedBigInteger('yearId')->nullable();
            $table->unsignedBigInteger('institutionId')->nullable();
            $table->unsignedInteger('levelId')->nullable();
            $table->unsignedBigInteger('rombelId')->nullable();
            $table->unsignedBigInteger('programId')->nullable();
            $table->unsignedBigInteger('boardingId')->nullable();
            $table->timestamps();
        });

        Schema::create('student_mutations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yearId');
            $table->unsignedBigInteger('institutionId');
            $table->unsignedBigInteger('studentId');
            $table->enum('type', [1, 2])->comment('1. Out, 2. In');
            $table->string('token');
            $table->string('numberLetter');
            $table->string('description')->nullable();
            $table->string('schoolNPSN')->nullable();
            $table->string('schoolName')->nullable();
            $table->string('schoolAddress')->nullable();
            $table->string('operatorName')->nullable();
            $table->string('operatorPhone')->nullable();
            $table->string('letterEmis')->nullable();
            $table->enum('status', [1, 2])->comment('1. unread, 2.read')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_mutations');
        Schema::dropIfExists('student_activities');
        Schema::dropIfExists('student_addresses');
        Schema::dropIfExists('student_parents');
        Schema::dropIfExists('students');
    }
};
