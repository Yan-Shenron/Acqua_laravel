<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoitierResource;
use App\Http\Resources\BoitierCollection;
use App\Models\Boitier;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// use App\Models\AdressBoitier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class BoitierController extends Controller
{

    public function updateBoitierInfo(Request $request, $id){
        $boitier = Boitier::find($id);
        $boitier->update($request->only(['dateActivation','comment', 'markerLat', 'markerLng', 'address', 'city', 'postcode', 'country', 'modeBoost', 'state', 'versionSoftware', 'generatorStateA', 'generatorStateB', 'ConnectionTimeLimit', 'mail_alerte']));
        $contract = Contract::where('boitier_id', $id)->first();
        $leasing = $request->input('leasing');
        $guarantee = $request->input('guarantee');
    
        $data = [];
        if (!empty($leasing)) {
            $data['leasing'] = $leasing;
            $data['initLeasing'] = now();
            switch ($leasing) {
                case 1:
                    $data['dateLeasing'] = now()->addMonths(12);
                    break;
                case 2:
                    $data['dateLeasing'] = now()->addMonths(24);
                    break;
                case 3:
                    $data['dateLeasing'] = now()->addMonths(36);
                    break;
                case 4:
                    $data['dateLeasing'] = now()->addMonths(48);
                    break;
                case 5:
                    $data['dateLeasing'] = null;
                    break;
            }
        }
    
        if (!empty($guarantee)) {
            $data['guarantee'] = $guarantee;
            $data['InitGuarantee'] = now();
            switch ($guarantee) {
                case 1:
                    $data['dateGuarantee'] = now()->addMonths(12);
                    break;
                case 2:
                    $data['dateGuarantee'] = now()->addMonths(24);
                    break;
                case 3:
                    $data['dateGuarantee'] = now()->addMonths(36);
                    break;
                case 4:
                    $data['dateGuarantee'] = now()->addMonths(48);
                    break;
            }
        }
        if($contract){
            $contract->update($data);
            return 'success';
        }
        else {
            $data['boitier_id'] = $id;
            $contract = Contract::create($data);
            return 'success';
        }
    
    }
    
    public function showCustomerListForAssign()
    {
        return User::where('role_id', 5)->get();
    }

    // public function updateCustomerName(Request $request, $id){
    //     $newUser_id = $request['user_id'];
    //     $boitier = Boitier::find($id);
    //     $boitier->user_id = $newUser_id;
    //     $boitier->save();

    //     return 'success';
    // }

    public function updateCustomerName(Request $request, $id){
        $user_id = $request['user_id'];
        $userName = User::where('id', $user_id)->get();
        foreach ($userName as $value) {
            $firstname = $value->firstname;
            $name = $value->name;
        }

        $NewUserName = $firstname . ' ' . $name;

        $boitier = Boitier::find($id);
        $boitier->customerName = $NewUserName;
        $boitier->user_id = $user_id;
        $boitier->save();
        return 'success';
    }

    public function index(Boitier $boitier){
        return new BoitierCollection($boitier->latest()->get());
    }

    public function showBoitierList(){

        $user = Auth::user();
    
        if (!$user) {
            return [];
        }
    
        $userId = $user->id;
        $userRole = $user->role_id;
    
        $query = Boitier::leftJoin('users', 'boitiers.user_id', '=', 'users.id')
            ->select('boitiers.id', 'boitiers.city', 'boitiers.state', 'boitiers.versionSoftware', DB::raw('COALESCE(users.name, "Unknown") as name'), DB::raw('COALESCE(users.firstname, "Unknown") as firstname'), 'boitiers.noSerie', 'boitiers.comment');
    
        switch ($userRole) {
            case '1': // admin
                break;
    
            case '2': // dealer (concessionaire)
                $reseller_ids = User::where('user_id', $userId)->where('role_id', 3)->pluck('id')->toArray();
                $query = $query->whereIn('boitiers.user_id', function ($query) use ($reseller_ids) {
                    $query->select('id')->from('users')->whereIn('user_id', $reseller_ids)->where('role_id', 5);
                });
                break;
    
            case '3': // reseller (revendeur)
                $query = $query->whereIn('boitiers.user_id', function ($query) use ($userId) {
                    $query->select('id')->from('users')->where('user_id', $userId)->where('role_id', 5);
                });
                break;
    
            case '4': // technicien
                $reseller_id = User::where('id', $userId)->first()->user_id;
                $query = $query->whereIn('boitiers.user_id', function ($query) use ($reseller_id) {
                    $query->select('id')->from('users')->where('user_id', $reseller_id)->where('role_id', 5);
                });
                break;
    
            case '5': // customer (client)
                $query = $query->where('boitiers.user_id', $userId);
                break;
        }
    
        $boitiers = $query->orderBy('boitiers.id', 'asc')->get();
        
        foreach ($boitiers as $item) {
            if($item->state == '1'){
                $item->state = 'actif';
            }
            else{
                $item->state = 'inactif';
            }
        }
    
        return $boitiers;
    }

    public function getBoitierBelongToUser($id)
    {
        $user = User::find($id);
        return $user->boitiers;
    }

    public function showBoitier($id){
        $data = Boitier::find($id);
        // $data->dateActivation = Carbon::parse($data->dateActivation)->format('d/m/Y');
        $data->user;
    
        if ($data->state == 1) {
            $data->state = 'actif';
        } else {
            $data->state = 'inactif';
        }
    
        if ($data->modeBoost == 1) {
            $data->modeBoost = 'actif';
        } else {
            $data->modeBoost = 'inactif';
        }

        if ($data->generatorStateA == 1) {
            $data->generatorStateA = 'actif';
        } else {
            $data->generatorStateA = 'inactif';
        }

        if ($data->generatorStateB == 1) {
            $data->generatorStateB = 'actif';
        } else {
            $data->generatorStateB = 'inactif';
        }

        if ($data->ConnectionTimeLimit == 1) {
            $data->ConnectionTimeLimit = 'sans délais';
        } else if($data->ConnectionTimeLimit == 2) {
            $data->ConnectionTimeLimit = '10 jours';
        } else if($data->ConnectionTimeLimit == 3) {
            $data->ConnectionTimeLimit = '30 jours';
        } else if($data->ConnectionTimeLimit == 4) {
            $data->ConnectionTimeLimit = '90 jours';
        } else {
            $data->ConnectionTimeLimit = '180 jours';
        }
    
        return $data;
    }

    public function showContract($id){
        try {
            $data = Contract::where('boitier_id', $id)->firstOrFail();
            if ($data->leasing != 5) {
                $data->dateLeasing = Carbon::parse($data->dateLeasing)->format('d/m/Y');
            }else{
                $data->dateLeasing = 'pas de contrat';
            }
            $data->dateGuarantee = Carbon::parse($data->dateGuarantee)->format('d/m/Y');
    
            if ($data->leasing == 1) {
                $data->leasing = '12 mois';
            } else if($data->leasing == 2) {
                $data->leasing = '24 mois';
            } else if($data->leasing == 3) {
                $data->leasing = '36 mois';
            } else if($data->leasing == 4) {
                $data->leasing = '48 mois';
            } else if($data->leasing == 5) {
                $data->leasing = 'pas de contrat';
            }
    
            if ($data->guarantee == 1) {
                $data->guarantee = '12 mois';
            } else if($data->guarantee == 2) {
                $data->guarantee = '24 mois';
            } else if($data->guarantee == 3) {
                $data->guarantee = '36 mois';
            } else if($data->guarantee == 4) {
                $data->guarantee = '48 mois';
            }
    
            return $data;
        } catch (\Exception $e) {
            return [
                'boitier_id' => $id,
                'dateLeasing' => '',
                'dateGuarantee' => '',
                'leasing' => '',
                'guarantee' => ''
            ];
        }
    }
    
    // public function countTotalBoitier(){
    //     return Boitier::all()->count();
    // }

    public function countTotalActiveInactiveBoitier() {
        $user = Auth::user();
        $id = $user->id;
        $role_id = $user->role_id;
    
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 5);
                    break;
                case 2: // Concessionaire
                    $revendeur_ids = User::where('user_id', $id)->where('role_id', 3)->pluck('id')->toArray();
                    $query->whereIn('user_id', $revendeur_ids)->where('role_id', 5);
                    break;
                case 3: // Revendeur
                    $query->where('user_id', $id)->where('role_id', 5);
                    break;
                case 4: // Technicien
                    $revendeur_id = User::where('id', $id)->first()->user_id;
                    $query->where('user_id', $revendeur_id)->where('role_id', 5);
                    break;
                case 5: // Customer
                    $query->where('id', $id)->where('role_id', 5);
                    break;
                default:
                    abort(403, 'Unauthorized');
            }
        };
    
        $clients = User::where($conditions)->get();
    
        $activeCount = 0;
        $inactiveCount = 0;
        $totalCount = 0;
        foreach ($clients as $client) {
            $activeCount += $client->boitiers()->where('state', 1)->count();
            $inactiveCount += $client->boitiers()->where('state', 0)->count();
            $totalCount += $client->boitiers()->count();
        }
        return ['activeCount' => $activeCount, 'inactiveCount' => $inactiveCount, 'totalCount' => $totalCount];
    }

    public function deleteBoitier($id)
    {

        $boitier = Boitier::all()->where('id', $id);
        // on cascade delete -> boitier_log -> labels -> sensor etc ...

        $boitier->each->delete();

        return 'succesfully deleted';
        
    }

    public function showAllPosition(){
        $boitier = Boitier::all();
    
        $data = [];
    
        foreach ($boitier as $item) {
            $marker = [
                'comment' => $item->comment,
                'id' => $item->id,
                'lat' => $item->markerLat,
                'lng' => $item->markerLng
            ];
            array_push($data, $marker);
        }
    
        return $data;
    }    
}
