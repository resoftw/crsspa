<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id'=>$this->id,
            'author_id'=>$this->id,
            'author_name'=>$this->author->name,
            'title'=>$this->title,
            'subtitle'=>$this->subtitle,
            'content'=>$this->content,
            'tags'=>$this->tags,
            'cover'=>$this->conver,
            'view_count'=>$this->view_count,
        ];
    }
}
