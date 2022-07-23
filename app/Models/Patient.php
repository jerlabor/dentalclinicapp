<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Patient extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'middle_name',
        'suffix',
        'last_name',
        'birth_date',
        'gender',
        'marital_status_id',
        'occupation',
        'spouse',
        'telephone',
        'mobile_no',
        'address',
        'height',
        'weight',
        'remarks',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


    /* Relationships */

    public function medicalHistory(): HasOne
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function dentalHistory(): HasOne
    {
        return $this->hasOne(DentalHistory::class);
    }

    public function illnesses()
    {
        return $this->belongsToMany(Illness::class)->withPivot('illness_details');
    }

    public function treatmentPlans(): HasMany
    {
        return $this->hasMany(TreatmentPlan::class);
    }

    public function maritalStatus(){
        return $this->belongsTo(MaritalStatus::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('patient')
            ->useDisk('local');
    }
}
