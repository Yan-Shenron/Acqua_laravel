<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertBoitierList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'valMin',
        'valMax',
        'unite',
        'isVisible',
        'mailed',
    ];

    protected $table = 'alert_boitier_lists';

    public function alertBoitiers()
    {
        return $this->hasMany(AlertBoitier::class);
    }
}