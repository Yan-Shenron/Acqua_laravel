<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boitier;
use App\Models\Label;
use App\Models\Sensor;

class SensorController extends Controller
{

    public function storeSensor(Request $request, $id)
    {
        $sensor = Sensor::create([
            'date'      => $request->date,
            'sensor_id'      => $request->sensor_id,
            'temperature'      => $request->temperature,
            'statut'      => $request->statut,
            'boitier_id'     => $id,
        ]);

        return $sensor;
    }

    public function showSensor($id){
        $label = Label::find($id);
        return $label->sensor;
    }


    public function getTemp($id){

        $labels = Label::where('boitier_id', $id)->get('sensor_id');

        $sensor = [];

        foreach ($labels as $value){
            $sensor_id = $value->sensor_id;
            array_push($sensor, $sensor_id);
        }

        $data = [];

        foreach($sensor as $value){
            $childData = Sensor::where('sensor_id', $value)->get();
            array_push($data, $childData);
        }

        return $data;
        
    }

    // public function
}