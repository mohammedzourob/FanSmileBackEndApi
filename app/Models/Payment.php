<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
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
