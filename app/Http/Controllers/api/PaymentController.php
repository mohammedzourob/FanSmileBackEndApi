<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Models\Pay;
use Illuminate\Http\JsonResponse;
use App\models\Payment;
use Illuminate\Support\Facades\DB;

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

    /**
     * Summary of show$payment = Payment::find($id);
     * @param mixed $id
     * @return JsonResponse
     *
     * the pay model get all pay with payment id and get date.
     * In the first condition $payment['appointmentId']  if it cannt null contune the get appointment id
     * else get operationId
     *
     */
    public function show($id)
    {
        $payment = Payment::where('id', $id)->first();
        $pay = Pay::where('paymentId', $id)->select('amount', DB::raw('DATE(created_at) as adedd'))->get();

        if ($payment['appointmentId'] != null) {
            $data = [
                'appointmentId' => $payment->appointmentId,
                'totalAmount' => $payment->totalAmount,
                'firstAmount' => $payment->firstAmount,
                'remainingAmount' => $payment->remainingAmount,
                'lastAmountPaid' => $payment->lastAmountPaid,
                'pays' => $pay,
            ];
            return parent::success($data);
        } else {
            $data = [
                'operationId' => $payment->operationId,
                'totalAmount' => $payment->totalAmount,
                'firstAmount' => $payment->firstAmount,
                'remainingAmount' => $payment->remainingAmount,
                'lastAmountPaid' => $payment->lastAmountPaid,
                'pays' => $pay,
            ];
            return parent::success($data);
        }



    }
    /**
     * Summary of update pay mayment
     * @param \App\Http\Requests\Payment\UpdatePaymentRequest $request
     * @param mixed $id
     * @return JsonResponse
     */
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

    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return parent::success('deleted successfully');
    }

}