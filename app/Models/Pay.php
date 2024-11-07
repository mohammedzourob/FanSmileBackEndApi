<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        "paymentId",
        "amount"
    ];

    /**
     * Get the payments that owns the Pay
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payments(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'paymentId', 'id');
    }
}