<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PrescriptionResource extends JsonResource
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
            'id'                => $this->id,
            'patient_id'        => $this->patient_id,
            'patient_name'      => ucwords( implode( ' ', [ $this->patient->first_name, $this->patient->last_name ] ) ),
            'prescription_date' => $this->prescription_date->format( 'Y-m-d' ),
            'created_at'        => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'        => $this->updated_at->format( 'Y-m-d H:i:s' ),
        ];

    }

}
