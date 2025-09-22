<?php

namespace App\Models\Finance;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    protected $fillable = [
        'institutionId',
        'parent',
        'code',
        'codeApp',
        'name',
        'level',
        'shown',
        'type',
        'debit',
        'credit',
        'balance'
    ];

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }
}
