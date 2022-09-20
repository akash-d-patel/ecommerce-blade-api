<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMessageResource extends JsonResource
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
                'sender' => new UserResource($this->sender),
                'receiver' => new UserResource($this->receiver),
                'message' => new MessageResource($this->Message),
                'created_at' => $this->created_at,
            ];
    }
}
