<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * prescription item belongs to
     * @return BelongsTo
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo( Prescription::class );

    }

}
