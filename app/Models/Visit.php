<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'visit_date'
    ];

    /**
     * patient vitit belongs to
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo( Patient::class );

    }

}
