<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class VisitResource extends JsonResource
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
            'patient_id'    => $this->patient_id,
            'patient'       => ucwords( implode( ' ', [ $this->patient->first_name, $this->patient->last_name ] ) ),
            'visit_date'    => $this->visit_date->format( 'Y-m-d' ),
            'symptoms'      => $this->symptoms,
            'diagnosis'     => $this->diagnosis,
            'created_at'    => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'    => $this->updated_at->format( 'Y-m-d H:i:s' ),
        ];

    }

}
