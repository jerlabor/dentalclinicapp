<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'dental_problem',
        'last_dental_visit',
        'previous_dentist',
        'address_previous_dentist',
    ];
}
