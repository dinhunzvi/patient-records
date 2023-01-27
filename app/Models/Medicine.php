<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * medicine's measurement unit
     * @return BelongsTo
     */
    public function measurement_unit(): BelongsTo
    {
        return $this->belongsTo( MeasurementUnit::class );

    }

}
