<?php

namespace App\Models\Finance;

use App\Models\Institution;
use App\Models\Institution\Program;
use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $fillable = [
        'yearId',
        'institutionId',
        'programId',
        'accountAppId',
        'accountRevId',
        'name',
        'alias',
        'gender',
        'boardingId',
        'repeat',
        'price'
    ];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'id', 'programId');
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'codeApp', 'accountId');
    }
}
