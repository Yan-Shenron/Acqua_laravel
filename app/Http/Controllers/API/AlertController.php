<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlertBoitierList;
use App\Models\AlertBoitier;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlertExport;
use Carbon\Carbon;

class AlertController extends Controller
{
    public function showAlertList(){
        $alert = AlertBoitierList::all();
        return $alert;
    }

    public function updateAlertList(Request $request, $id){
        $alert = AlertBoitierList::find($id);
        $alert->update($request->all());
        return 'success';
    }

    public function lastAlert()
    {
        $user = Auth::user();
    
        if (!$user) {
            return [];
        }
    
        $userId = $user->id;
        $userRole = $user->role_id;
    
        $query = AlertBoitier::with('alertBoitierList');
    
        switch ($userRole) {
            case '1': // admin
                // For admin, fetch all alerts.
                break;
    
            case '2': // dealer (concessionaire)
                $reseller_ids = User::where('user_id', $userId)->where('role_id', 3)->pluck('id')->toArray();
                $query->whereHas('boitier', function ($query) use ($reseller_ids) {
                    $query->whereIn('user_id', function ($query) use ($reseller_ids) {
                        $query->select('id')->from('users')->whereIn('user_id', $reseller_ids)->where('role_id', 5);
                    });
                });
                break;
    
            case '3': // reseller (revendeur)
                $query->whereHas('boitier', function ($query) use ($userId) {
                    $query->whereIn('user_id', function ($query) use ($userId) {
                        $query->select('id')->from('users')->where('user_id', $userId)->where('role_id', 5);
                    });
                });
                break;
    
            case '4': // technicien
                $reseller_id = User::where('id', $userId)->first()->user_id;
                $query->whereHas('boitier', function ($query) use ($reseller_id) {
                    $query->whereIn('user_id', function ($query) use ($reseller_id) {
                        $query->select('id')->from('users')->where('user_id', $reseller_id)->where('role_id', 5);
                    });
                });
                break;
    
            case '5': // customer (client)
                $query->whereHas('boitier', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
                break;
        }
    
        $alerts = $query->latest()->take(5)->get();

        $processedAlerts = [];
    
        foreach ($alerts as $alert) {
            $alert_boitier_list = $alert->alertBoitierList;
            $alert_boitier_list_title = $alert_boitier_list->title;
            $alert_boitier_boitier_id = $alert->boitier_id;
            $alert_boitier_value = $alert->value;
            $alert_boitier_unite = $alert_boitier_list->unite;
            $alert_boitier_datetime = Carbon::createFromTimestamp($alert->datetime)->format('d-m-Y H:i:s');
    
            array_push($processedAlerts, [
                'boitier_id' => $alert_boitier_boitier_id,
                'title' => $alert_boitier_list_title,
                'datetime' => $alert_boitier_datetime,
                'value' => $alert_boitier_value,
                'unite' => $alert_boitier_unite
            ]);
        }
    
        return $processedAlerts;
    }
    

    public function lastAlertByBoitier($id){
        $alerts = AlertBoitier::where('boitier_id', $id)->with('alertBoitierList')->latest()->take(3)->get();
    
        $data = [];
    
        foreach ($alerts as $alert) {
            $alert_boitier_list = $alert->alertBoitierList;
            $alert_boitier_list_title = $alert_boitier_list->title;
            $alert_boitier_boitier_id = $alert->boitier_id;
            $alert_boitier_value = $alert->value;
            $alert_boitier_unite = $alert_boitier_list->unite;
            $alert_boitier_datetime = Carbon::createFromTimestamp($alert->datetime)->format('d-m-Y H:i:s');
    
            array_push($data, [
                'boitier_id' => $alert_boitier_boitier_id,
                'title' => $alert_boitier_list_title,
                'datetime' => $alert_boitier_datetime,
                'value' => $alert_boitier_value,
                'unite' => $alert_boitier_unite
            ]);
        }
    
        return $data;
    }

    public function everyAlertByBoitier($id){
        $alerts = AlertBoitier::where('boitier_id', $id)->with('alertBoitierList')->latest()->get();
    
        $data = [];
    
        foreach ($alerts as $alert) {
            $alert_boitier_list = $alert->alertBoitierList;
            $alert_boitier_list_title = $alert_boitier_list->title;
            $alert_boitier_value = $alert->value;
            $alert_boitier_unite = $alert_boitier_list->unite;
            $alert_boitier_datetime = Carbon::createFromTimestamp($alert->datetime)->format('d-m-Y H:i:s');
    
            array_push($data, [
                'title' => $alert_boitier_list_title,
                'value' => $alert_boitier_value,
                'unite' => $alert_boitier_unite,
                'datetime' => $alert_boitier_datetime,
            ]);
        }
    
        return $data;
    }

    public function exportAlertLog($id){
        
        return Excel::download(new AlertExport($id), 'alert.csv');
    }
}