<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return
            [
                'id' => $this->id,
                'client_id' => $this->client_id,
                'brand' => new BrandResource($this->brand),
                'name' => $this->name,
                'description' => $this->description,
                'order' => $this->order,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
