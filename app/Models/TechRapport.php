<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechRapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenanceDate',
        'time',
        'type',
        'comment',
    ];

    public function techRapportPhoto(){
        
        return $this->hasMany(TechRapportPhoto::class, 'tech_id', 'id');
    }

    public function boitier(){
        
        return $this->belongsTo(Boitier::class);
    }
}