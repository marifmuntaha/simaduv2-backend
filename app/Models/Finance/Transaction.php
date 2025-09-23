<?php

namespace App\Models\Finance;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $table = 'finance_transactions';
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

    protected function amount(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::replace('.', '', $value),
        );
    }

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
