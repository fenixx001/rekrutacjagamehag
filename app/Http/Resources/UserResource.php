<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active,
            'banned' => $this->banned,
            'avatar' => $this->avatar,
            'points' => $this->points,
            'geo' => $this->geo,
            'lang' => $this->lang,
            'ref' => $this->ref,
            'ref_status' => $this->ref_status,
            'ref_code' => $this->ref_code,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
