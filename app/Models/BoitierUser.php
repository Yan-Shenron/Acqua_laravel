<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoitierUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'boitier_id',
        'user_id'
    ];

    protected $table = 'boitier_users';
}
