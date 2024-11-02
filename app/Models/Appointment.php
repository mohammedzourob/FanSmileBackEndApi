<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Appointment extends Model
{
    use SoftDeletes;
    protected $fillable=[
    'userId',
    'patientId',
    'startDate',
    'endDate',
    'details',
    'status'
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
