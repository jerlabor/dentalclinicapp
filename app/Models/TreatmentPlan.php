<?php

namespace App\Models;

use App\Casts\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreatmentPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'treatment',
        'patient_id',
        'treatment',
        'status_id',
        'total_fee',
    ];

    protected $appends = [
        'balance'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:m/d/Y',
        'total_fee' => Money::class.':2'
    ];

    /*Relationships*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function transactions(){
        return $this->hasMany(TreatmentPlanTransaction::class)->oldest();
    }

    /*Accessors*/
    public function getTotalPaidAttribute(){
        return $this->loadSum('transactions','fee')->transactions_sum_fee;
    }

    public function getBalanceAttribute(){
        return number_format($this->attributes['total_fee'] - $this->getTotalPaidAttribute(),2,'.','');
    }

}
