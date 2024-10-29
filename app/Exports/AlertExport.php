<?php

namespace App\Exports;

use App\Models\AlertBoitierList;
use App\Models\AlertBoitier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;

class AlertExport implements FromCollection
{

    use Exportable;

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function collection()
    {
        $alerts = AlertBoitier::where('boitier_id', $this->id)->with('alertBoitierList')->latest()->get();
    
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

        return collect($data);
    }
}

