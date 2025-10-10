<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LSNepomuceno\LaravelA1PdfSign\Sign\ManageCert;
use Throwable;

class Certificate extends Model
{
    protected $fillable = ['userId', 'certificate', 'password', 'hash'];

    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function parse(): ?ManageCert
    {
        return decryptCertData(base64_decode($this->hash), $this->certificate, $this->password, false);
    }
}
