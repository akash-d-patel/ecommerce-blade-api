<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimezoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'client_id' => $this->client_id,
                'name' => $this->name,
                'abbreviation' => $this->abbreviation,
                'offSet' => $this->offSet,
                'created_at' => $this->created_at,
            ];
    }
}
