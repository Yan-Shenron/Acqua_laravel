<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Boitier;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function storeLocation(Request $request, $id)
    {
        $loc = Location::create([
            'locationGps' =>$request->locationGps,
            'boitier_id' =>$id,
        ]);
    }

    public function showLocation($id)
    {
        $box = Boitier::find($id);
        return $box->location;
    }
}
