<?php
declare (strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array 
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'body'  => $this->body,
            'name'  => $this->users->name,
            'email' => $this->users->email,
            'file'  => true,
            'new'  => $this->new,
            'date'  => $this->created_at->format('Y-m-d')
        ];
    }
}
