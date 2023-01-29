<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientVisit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'visit_date'
    ];

    /**
     * patient prescription belongs to
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo( Patient::class );

    }

    /**
     * user who created patient visit
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );

    }

}
