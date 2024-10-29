<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechRapportPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'boitier_id',
    ];

    public function boitiers(){
        
        return $this->belongsTo(Boitier::class);
    }
}
