<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use SoftDeletes;
    protected $fillable=[
    'userId',
    'patientId',
    'photo',
    'date',
    'status',
    'details',
    'operationNumber'
    ];


    public function users()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function patients()
    {
        return $this->belongsTo(Patient::class,'patientId','id');
    }
}