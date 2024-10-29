<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ph extends Model
{
    use HasFactory;

    public function Boitier(){
        
        return $this->belongsTo(Boitier::class);
    }

    public function phLog(){
        
        return $this->hasMany(BoitierLog::class, 'ph_id', 'id');
    }
}
