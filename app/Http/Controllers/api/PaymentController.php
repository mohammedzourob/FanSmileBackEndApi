<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\models\Payment;

class PaymentController extends Controller
{


    public function store(StorePaymentRequest $request): JsonResponse
    {

        $request->validated();
        $total = $request['totalAmount'];
        $first = $request['firstAmount'];

        $request['remainingAmount'] = $total - $first;
        $request['lastAmountPaid'] = $first;
        Payment::create($request->all());

        return parent::success('payment has added successfully');
    }

    public function update(UpdatePaymentRequest $request, $id)
    {
        $validation = $request->validated();
        $payment = Payment::findOrFail($id);
        $total = $request['totalAmount'];
        $first = $request['firstAmount'];

        $payment['remainingAmount'] = $total - $first;
        $payment['lastAmountPaid'] = $total - $first;
        $payment->update($validation);

        return parent::success('payment has added successfully');
    }
}
