<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserRoleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($data)
    {
        return parent::toArray($data);
    }
}
