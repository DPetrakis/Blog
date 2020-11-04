<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
            'id' => $this->id,
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y'),
            'user' => $this->user,
            'post' => $this->post
        ];
    }
}
