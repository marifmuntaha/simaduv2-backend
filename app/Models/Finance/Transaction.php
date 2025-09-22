<?php

namespace App\Models\Finance;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $fillable = [
        'institutionId',
        'accountAppId',
        'accountRevId',
        'code',
        'number',
        'name',
        'amount',
        'balance'
    ];

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function accountApp(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'accountAppId');
    }

    public function accountRev(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'accountRevId');
    }
}
