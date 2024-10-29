<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertBoitier extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'datetime',
        'sended',
        'boitier_id',
        'alert_boitier_list_id'
    ];

    protected $table = 'alert_boitiers';

    public function alertBoitierList()
    {
        return $this->belongsTo(AlertBoitierList::class);
    }

    public function boitier()
    {
        return $this->belongsTo(Boitier::class);
    }
}
