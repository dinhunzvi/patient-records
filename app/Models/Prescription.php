<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * patient prescription belongs to
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo( Patient::class );

    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );

    }

    protected $dates = [
        'prescription_date'
    ];

    /**
     * medicines/items in prescription
     * @return HasMany
     */
    public function prescription_items(): HasMany
    {
        return $this->hasMany( PrescriptionItem::class );

    }

}
