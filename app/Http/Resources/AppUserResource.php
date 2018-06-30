<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppUserResource extends JsonResource
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
        'User ID'=>$this->id,
        'Firstname'=>$this->firstname,
        'Lastname'=>$this->lastname,
        'Email Address'=>$this->email
        ];
    }
}
