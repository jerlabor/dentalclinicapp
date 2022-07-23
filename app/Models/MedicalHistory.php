<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_care_of_physician',
        'hospitalized',
        'hospitalized_reason',
        'is_taking_medication',
        'medications',
        'allergic',
        'allergy_details',
        'smoke'
    ];

    public function physician(): HasOne
    {
        return $this->hasOne(Physician::class);
    }
}
