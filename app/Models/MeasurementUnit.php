<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * medicines that use this measurement unit
     * @return HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany( Medicine::class );

    }

}
