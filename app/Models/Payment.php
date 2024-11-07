<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'appointmentId',
        'operationId',
        'totalAmount',
        'firstAmount',
        'remainingAmount',
        'lastAmountPaid'
    ];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'appointmentId', 'id');
    }

    public function operations()
    {
        return $this->belongsTo(Operation::class, 'operationId', 'id');
    }

}
