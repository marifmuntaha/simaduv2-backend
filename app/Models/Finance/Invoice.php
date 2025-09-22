<?php

namespace App\Models\Finance;

use App\Models\Institution;
use App\Models\Student;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = ['institutionId', 'itemId', 'studentId', 'number', 'name', 'amount', 'status'];

    protected function amount(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::replace('.', '', $value),
        );
    }

    public function institution() : HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function item() : HasOne
    {
        return $this->hasOne(Item::class, 'id', 'itemId');
    }

    public function student() : HasOne
    {
        return $this->hasOne(Student::class, 'id', 'studentId');
    }


}
