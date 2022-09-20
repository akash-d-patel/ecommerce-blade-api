<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
                'note' => $this->note,
                'is_complete' => $this->is_complete,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
