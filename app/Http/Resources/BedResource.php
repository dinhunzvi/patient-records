<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class BedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id'            => $this->id,
            'ward_id'       => $this->ward_id,
            'ward'          => $this->ward->name,
            'name'          => $this->name,
            'created_at'    => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'    => $this->updated_at->format( 'Y-m-d H:i:s' ),
        ];

    }

}
