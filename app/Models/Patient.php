<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=[
        'firstName',
        'lastName',
        'idNumber',
        'patientNumber',
        'bloodType',
        'gender',
        'address',
        'phone',
        'dob',
    ];

    public function appointments()
    {
        return  $this->hasOne(Appoiment::class);
    }
}