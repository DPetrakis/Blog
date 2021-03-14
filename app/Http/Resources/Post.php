<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'breaking_news' => $this->breaking_news,
            'category' => $this->category,
            'image' => $this->image,
            'tags' => $this->tags,
            'comments' => $this->comments->load('user'),
            'author' => $this->admin 
        
        ];
    }
}
