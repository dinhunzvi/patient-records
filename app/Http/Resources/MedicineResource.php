<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id'                    => $this->id,
            'measurement_unit_id'   => $this->measurement_unit_id,
            'measurement_unit_name' => $this->measurement_unit->name,
            'name'                  => ucwords( $this->name ),
            'created_at'            => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'            => $this->created_at->format( 'Y-m-d H:i:s' ),

        ];

    }

}
