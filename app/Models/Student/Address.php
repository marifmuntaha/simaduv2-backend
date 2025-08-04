<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'student_addresses';
    protected $fillable = ['studentId', 'provinceId', 'cityId', 'districtId', 'villageId', 'address'];
}
