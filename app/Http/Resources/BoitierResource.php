<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoitierResource extends JsonResource
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
            'noSerie' => $this->noSerie,
            'dateActivation' => $this->dateActivation,
            'firstConnect' => $this->firstConnect,
            'lastUpdate' => $this->lastUpdate,
            'lastMoved' => $this->lastMoved,
            'ConnectionTimeLimit' => $this->ConnectionTimeLimit,
            'versionSoftware' => $this->versionSoftware,
            'language' => $this->language,
            'comment' => $this->comment,
            'state' => $this->state,
            'isOpen' => $this->isOpen,
            'phModule' => $this->phModule,
            'hasGsm' => $this->hasGsm,
            'user_id' => $this->user_id,
        ];
    }
}


