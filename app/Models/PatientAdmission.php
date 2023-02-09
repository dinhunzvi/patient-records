<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientAdmission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'admission_date', 'discharge_date'
    ];

    /**
     * patient who has been admitted
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo( Patient::class );

    }

    /**
     * ward patient was assigned to
     * @return BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo( Ward::class );

    }

    /**
     * bed patient was assigned
     * @return BelongsTo
     */
    public function bed(): BelongsTo
    {
        return $this->belongsTo( Bed::class );

    }

}
