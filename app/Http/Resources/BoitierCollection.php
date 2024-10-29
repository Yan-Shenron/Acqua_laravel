<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class BoitierCollection extends ResourceCollection
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
                        'id'                => $data->id,
                        'noSerie'           => $data->noSerie,
                        'dateActivation'    => $data->dateActivation,
                        'firstConnect'      => $data->firstConnect,
                        'lastUpdate'        => $data->lastUpdate,
                        'lastMoved'         => $data->lastMoved,
                        'ConnectionTimeLimit' => $data->ConnectionTimeLimit,
                        'versionSoftware'   => $data->versionSoftware,
                        'language'          => $data->language,
                        'comment'           => $data->comment,
                        'state'             => $data->state,
                        'isOpen'            => $data->isOpen,
                        'phModule'          => $data->phModule,
                        'hasGsm'            => $data->hasGsm,
                        'user_id'           => $data->user_id,
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
