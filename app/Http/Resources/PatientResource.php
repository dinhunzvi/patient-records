<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PatientResource extends JsonResource
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
            'first_name'    => ucwords( $this->first_name ),
            'last_name'     => ucwords( $this->last_name ),
            'patient_name'  => ucwords( implode( ' ', [ $this->first_name, $this->last_name ] ) ),
            'id_number'     => strtoupper( $this->id_number ),
            'dob'           => $this->dob->format( 'Y-m-d' ),
            'address'       => ucwords( $this->address ),
            'gender'        => $this->gender,
            'created_at'    => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'    => $this->updated_at->format( 'Y-m-d H:i:s' ),

        ];

    }

}
