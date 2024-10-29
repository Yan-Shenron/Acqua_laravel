<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BoitierLogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'boitier' => $this->collection->map(function($data) {
                    return [
                        'date' => $data->date,
                        'sensor1' => $data->sensor1,
                        'sensor2' => $data->sensor2,
                        'sensor3' => $data->sensor3,
                        'sensor4' => $data->sensor4,
                        'temperature' => $data->temperature,
                        'humidity' => $data->humidity,
                        'coilState1' => $data->coilState1,
                        'coilState2' => $data->coilState2,
                        'generatorStateA' => $data->generatorStateA,
                        'generatorStateB' => $data->generatorStateB,
                        'modeBoost' => $data->modeBoost,
                        'boitier_id' => $data->boitier_id,
                        // 'created_at'    => Carbon::parse($data->created_at)->toDateTimeString()
                    ];
                })
            ]
        ];
    }

    public function with($request)
    {
        return [
            'isSuccess' => true,
            'message' => ''
        ];
    }
}
