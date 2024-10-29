<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id" => $this->id,
            "name" => ucfirst($this->name),
            "firstname" => ucfirst($this->firstname),
            "email" => $this->email,
            "phone1" => $this->phone1,
            "phone2" => $this->phone2,
            "company" => $this->company,
            "website" => $this->website,
            "siret" => $this->siret,
            "tva" => $this->tva,
            "comment" => $this->comment,
            "role_id" => $this->role_id,
        ];
    }
}