<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentUser as CommentUserResource;
class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            // 'content_id' => $this->id,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'Updated_at' => $this->updated_at,
            'content' => $this->content,
            'user' => new CommentUserResource($this->user),
            // 'user' => new CommentUserResource($this->whenLoaded('user'))
        ];
    }
}
