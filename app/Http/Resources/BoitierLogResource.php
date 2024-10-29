<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoitierLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'date' => $this->date,
            'sensor1' => $this->sensor1,
            'sensor2' => $this->sensor2,
            'sensor3' => $this->sensor3,
            'sensor4' => $this->sensor4,
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'coilState1' => $this->coilState1,
            'coilState2' => $this->coilState2,
            'generatorStateA' => $this->generatorStateA,
            'generatorStateB' => $this->generatorStateB,
            'modeBoost' => $this->modeBoost,
            'boitier_id' => $this->boitier_id,
        ];
    }
}