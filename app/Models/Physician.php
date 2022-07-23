<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{
    use HasFactory;

    protected $fillable = [
        'physician_name',
        'address',
        'months_attended',
        'contact_no',
    ];
}
