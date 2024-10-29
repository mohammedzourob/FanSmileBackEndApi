<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;

use App\models\Patient;
use Illuminate\Support\Str;
class PatientController extends Controller
{

    public function create(PatientRequest $request): JsonResponse
    {
        $validation=$request->validated();
        $request['patientNumber']=rand(1000000, 9999999);
        $patient=Patient::create($request->all());
        return parent::success($patient);
    }

    public function update(UpdatePatientRequest $request ,$id): JsonResponse
    {
        $validation=$request->validated();
        $patient=Patient::findorFail($id);


        $patient->update($request->all());

        return parent::success($patient);

    }

}