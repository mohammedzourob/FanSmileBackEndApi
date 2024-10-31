<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\appointment\StoreAppointmentRequest;
use Illuminate\Http\JsonResponse;
use App\models\Appointment;

class AppointmentController extends Controller
{

    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $validation=$request->validated();

        $appointment=Appointment::create($request->all());

        return parent::success($appointment);
    }
}