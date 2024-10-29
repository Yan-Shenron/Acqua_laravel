<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoitierLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'temperature',
        'humidity',
        'coilState1',
        'coilState2',
        'generatorStateA',
        'generatorStateB',
        'modeBoost',
        'boitier_id',
    ];

    public function boitier(){
        
        return $this->belongsTo(Boitier::class);
    }
}