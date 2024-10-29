<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;

class DataExport implements FromCollection
{

    use Exportable;

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function collection()
    {
        $data = DB::table($this->id.'_boitier_datas')
        ->orderBy('epoch_date', 'desc')
        ->limit(500)
        ->get();
        foreach ($data as $item) {
        $item->epoch_date = Carbon::createFromTimestamp($item->epoch_date)->format('d-m-Y H:i:s');
        }

        return collect($data);
    }
}

