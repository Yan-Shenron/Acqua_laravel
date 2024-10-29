<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoitierLogResource;
use App\Http\Resources\BoitierLogCollection;
use App\Models\BoitierLog;
use App\Models\Boitier;
use Illuminate\Http\Request;

class BoitierLogController extends Controller
{

    
    // public function storeLog(Request $request, $id)
    // {
    //     $boitierLog = BoitierLog::create([
    //         'date'      => $request->date,
    //         'temperature'     => $request->temperature,
    //         'humidity'     => $request->humidity,
    //         'coilState1'     => $request->coilState1,
    //         'coilState2'     => $request->coilState2,
    //         'generatorStateA'     => $request->generatorStateA,
    //         'generatorStateB'     => $request->generatorStateB,
    //         'modeBoost'     => $request->modeBoost,
    //         'boitier_id'     => $id,
    //     ]);

    //     return $boitierLog;
    // }

    // public function showLog($id)
    // {
    //     $box = Boitier::find($id);
    //     return $box->boitierlog;

    // }

}
