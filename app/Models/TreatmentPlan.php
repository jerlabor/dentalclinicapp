<?php

namespace App\Models;

use App\Casts\Money;
use App\Enums\TreatmentStatusEnum;
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
        'created_at'
    ];

    protected $appends = [
        'balance',
        'paid',
        'hasBalance'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'total_fee' => 'decimal:2',
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
        return $this->hasMany(TreatmentPlanTransaction::class)->oldest('transaction_date');
    }

    /*Accessors*/
    public function getTotalPaidAttribute(){
        return $this->loadSum('transactions','fee')->transactions_sum_fee;
    }

    public function getBalanceAttribute(){
        return round($this->attributes['total_fee'] - $this->getTotalPaidAttribute(),2);
    }

    public function getPaidAttribute(){
        return $this->attributes['status_id'] === TreatmentStatusEnum::Paid->value;
    }

    public function getHasBalanceAttribute(){
        return $this->getBalanceAttribute() != 0;
    }

}
