<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
                'title' => $this->title,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'order' => $this->order,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)

            ];
    }
}
