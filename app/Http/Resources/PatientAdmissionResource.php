<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PatientAdmissionResource extends JsonResource
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
            'patient_name'      =>
                ucwords( implode( ' ', [ $this->patient->first_name, $this->patient_last_name ] ) ),
            'ward_id'           => $this->ward_id,
            'ward_name'         => $this->ward->name,
            'bed_id'            => $this->bed_id,
            'bed_name'          => $this->bed->name,
            'admission_date'    => $this->admission_date->format( 'Y-m-d' ),
            'discharged'        => isset( $this->discharge_date ) ? 'Yes' : 'No',
            'discharge_date'    => isset( $this->discharge_date ) ? $this->discharge_date->format( 'Y-m-d') : '',
            'created_at'        => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'        => $this->updated_at->format( 'Y-m-d H:i:s' ),
        ];

    }

}
