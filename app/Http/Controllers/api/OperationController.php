<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\operation\StoreOperationRequest;
use App\Http\Requests\operation\UpdateOperationRequest;
use Illuminate\Http\Request;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    public function index()
    {

        $operation=Operation::where('status','!=','cancelled')->where('deleted_at',null)->simplePaginate(10);
        $data=$operation->map(function($p){
            return[
                'doctor'=>$p->users['name'],
                'patient'=>$p->patients['firstName'].' '.$p->patients['lastName'],
                'date'=>$p->date,
                'details'=>$p->details
            ];
        });

        return parent::success($data);
    }

    public function store(StoreOperationRequest $request):JsonResponse
    {
        $valiation=$request->validated();
        $request['operationNumber']=rand(1000000,9999999);
        $operation=Operation::create($request->all());

        return parent::success('operation has successfully');
    }

    public function update(UpdateOperationRequest $request,$id):JsonResponse
    {
        $operation=Operation::findOrFail($id);
        $valiation=$request->validated();

        $operation->update($valiation);
        return parent::success('update successfully');
    }
    
}