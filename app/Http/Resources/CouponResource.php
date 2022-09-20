<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
                'code' => $this->code,
                'discount_type' => $this->discount_type,
                'no_of_attemets' => $this->no_of_attemets,
                'minimum_order_value' => $this->minimum_order_value,
                'maximum_discount' => $this->maximum_discount,
                'expire_date' => $this->expire_date,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'created_by' => new UserResource($this->creater)
            ];
    }
}
