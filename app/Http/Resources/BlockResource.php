<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
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
            'layout' => $this->layout,
            'position' => sprintf('%04d', $this->position),
            'content' => json_decode($this->content),
            'edit_mode' => false,
            'is_text_or_quote' => $this->is('text') || $this->is('title') || $this->is('list'),
            'is_image' => $this->is('image'),
            'is_link' => $this->is('link'),
            'is_video' => $this->is('video'),
            'images' => ImageResource::collection($this->images),
        ] + (is_array($this->mapContent()) ? $this->mapContent() : []);
    }
}
