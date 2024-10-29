<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boitier extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'noSerie',
        'dateActivation',
        'firstConnect',
        'lastUpdate',
        'lastMoved',
        'ConnectionTimeLimit',
        'versionSoftware',
        'language',
        'customerName',
        'comment',
        'state',
        'isOpen',
        'phModule',
        'hasGsm',
        'modeBoost',
        'coilStateA',
        'coilStateB',
        'generatorStateA',
        'generatorStateB',
        'since_connect',
        'moyen_co',
        'markerLat',
        'markerLng',
        'address',
        'postcode',
        'city',
        'country',
        'user_id',
        'mail_alerte',
    ];

    protected $table = 'boitiers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alert_boitier_list_id(){
        return $this->belongsToMany('App\Models\AlertBoitierList', 'boitiers', 'boitier_id', 'alert_boitier_list_id');
    }

    public function Location(){
        return $this->hasMany(Location::class, 'boitier_id', 'id');
    }

    public function contract(){
        
        return $this->hasOne(Contract::class);
    }

    public function sim(){  
        return $this->hasOne(Sim::class, 'boitier_id', 'id');
    }

    public function techRapport(){  
        return $this->hasOne(TechRapport::class, 'boitier_id', 'id');
    }
}