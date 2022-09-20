<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
                'shortdescription' => $this->shortdescription,
                'description' => $this->description,
                'status' => $this->status,
                'order' => $this->order,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)

            ];
    }
}
