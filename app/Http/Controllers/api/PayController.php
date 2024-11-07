<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pay\StorePayRequest;
use App\Http\Requests\Pay\UpdatePayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Pay;
use App\Models\Payment;

class PayController extends Controller
{

    /**
     * Summary of store
     * @param \App\Http\Requests\Pay\StorePayRequest $request
     * @return \Illuminate\Http\JsonResponse
     * In the first condition i am checking the payment remining amount if can = 0 to return message.
     * In the second condition i am checking the amount paid if can > remining amount payment to return message.
     * In the end i am update remainingAmount and lastAmountPaid , and submit data to pay.
     */
    public function store(StorePayRequest $request): JsonResponse
    {
        $payment = Payment::where('id', $request->validated()['paymentId'])->first();
        if ($payment->remainingAmount === 0) {
            return parent::success("the remaining amount is 0 Payment coonet be made");
        } elseif ($request->validated()['amount'] > $payment->remainingAmount) {

            return parent::success('the amount paid is greater then the remining amount .');
        } else {
            $p = $payment['remainingAmount'] - $request->validated()["amount"];
            $payment['remainingAmount'] = $p;
            $payment['lastAmountPaid'] = $request->validated()['amount'];
            $payment->update();

            Pay::create($request->validated());
            return parent::success("pay has been adedd successfully .");
        }
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Pay\UpdatePayRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     * in this function i am change $payment['remainingAmount'] to previous value and update $payment['lastAmountPaid'], and update $payment['remainingAmount'].
     * In the first condition i am checking the payment remining amount if can = 0 to return message.
     * In the second condition i am checking the amount paid if can > remining amount payment to return message.
     * In the end i am update payment and pay.
     */
    public function update(UpdatePayRequest $request, $id): JsonResponse
    {
        $validation = $request->validated();
        $pay = Pay::findOrFail($id);
        $payment = Payment::where('id', $request->validated()["paymentId"])->first();
        $payment['remainingAmount'] += $payment['lastAmountPaid'];
        $payment['lastAmountPaid'] = $request->validated()['amount'];
        $payment['remainingAmount'] = $payment['remainingAmount'] - $request->validated()['amount'];

        if ($payment->remainingAmount === 0) {
            return parent::success("the remaining amount is 0 Payment coonet be made");
        } elseif ($request->validated()["amount"] > $payment->remainingAmount) {
            return parent::success('the amount paid is greater then the remining amount .');

        } else {

            $payment->update();
            $pay->update($validation);
            return parent::success("pay has been adedd successfully .");
        }





    }
}
