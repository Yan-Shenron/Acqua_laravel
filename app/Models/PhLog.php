<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhLog extends Model
{
    use HasFactory;

    public function Ph(){
        
        return $this->belongsTo(Ph::class);
    }
}
