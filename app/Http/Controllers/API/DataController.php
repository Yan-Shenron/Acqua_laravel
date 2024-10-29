<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Models\Boitier;
use Carbon\Carbon;
class DataController extends Controller
{
  
    public function getInternData($id) {
        $config = DB::table($id . '_boitier_capteurs')
            ->where('type', 'Dht11')
            ->get();
    
        $pk = [];
        foreach ($config as $value) {
            $primaryKey = $value->id;
            array_push($pk, $primaryKey);
        }
    
        $data = DB::table($id . '_boitier_datas')
            ->orderBy('epoch_date', 'desc')
            ->first();
    
        $result = [];
        foreach ($pk as $value) {
            $result['id'] = $data->id;
            $result['epoch_date'] = $data->epoch_date;
            // $result['capteur_' . $value . '_id'] = $value;
            $result['capteur_' . $value . '_data'] = $data->{'capteur_' . $value . '_data'};
        }
    
        return $result;
    }

    public function getConfig($id){
        $label = DB::table($id.'_boitier_capteurs')
                ->get();
        return $label;
    }

    public function showBoitierLog($id){
        // add label to title
        $data = DB::table($id.'_boitier_datas')
                ->orderBy('epoch_date', 'desc')
                ->limit(300)
                ->get();
        foreach ($data as $item) {
            $item->epoch_date = Carbon::createFromTimestamp($item->epoch_date)->format('d-m-Y H:i:s');
        }
        return $data;
    }
    
    public function getAllChartData($id){
        $data = DB::table($id.'_boitier_datas')
        ->orderBy('epoch_date', 'desc')
        ->get();
        return $data;
    }

    public function exportBoitierLog($id){
        
        return Excel::download(new DataExport($id), 'data.csv');
    }

}
