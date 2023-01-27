<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * patient's visits
     * @return HasMany
     */
    public function patient_visits(): HasMany
    {
        return $this->hasMany( PatientVisit::class );

    }

    protected $dates = [
        'dob'
    ];

    /**
     * patient's prescriptions
     * @return HasMany
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany( Prescription::class );

    }

}
