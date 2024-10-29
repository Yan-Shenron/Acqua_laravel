<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'leasing',
        'initLeasing',
        'dateLeasing',
        'guarantee',
        'InitGuarantee',
        'dateGuarantee',
        'evolution',
        'status_mail',
        'boitier_id'
    ];
}