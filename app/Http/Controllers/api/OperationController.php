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

    /**
     * the index function talking about get all opreation that wating and done .
     * for the map to facilitate the work of mobile developers .
     */

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

    /**
     * the store function talking about save operation data to database .
     * the request['operationNumber'] to create serial number to opration unquel.
     */

    public function store(StoreOperationRequest $request):JsonResponse
    {
        $valiation=$request->validated();
        $request['operationNumber']=rand(1000000,9999999);
        $operation=Operation::create($request->all());

        return parent::success('operation has successfully');
    }

    /**
     * the update function taking about update operation data and change the status .
     */

    public function update(UpdateOperationRequest $request,$id):JsonResponse
    {
        $operation=Operation::findOrFail($id);
        $valiation=$request->validated();

        $operation->update($valiation);
        return parent::success('update successfully');
    }


    /**
     * the show function talking about get one operation via id .
     * and $operationData to return data in object not array.
     */
    public function show($id)
    {
        $operation=Operation::where([
            ['id',$id],
            ['status','wating'],
            ['deleted_at',null]

            ])->orWhere('status','done')->first();

            if($operation != null)
            {
                $operationData=[
                    'id'=>$operation->id,
                     'doctor'=>$operation->users['name'],
                     'patient'=>$operation->patients['firstName'].' '.$operation->patients['lastName'],
                     'opreationNumber'=>$operation->operationNumber,
                     'photo'=>$operation->photo,
                     'dateTime'=>$operation->date,
                     'details'=>$operation->details
                    ];

                return parent::success($operationData);
            }else{
                return parent::success('operation has deleted or cancelled ');
            }

    }

    /**
     * the delete function to remove the operation in view but it's save in database deleted_at
     */
    public function delete($id)
    {
        $operation=Operation::findOrFail($id);
        $operation->delete();

        return parent::success('deleted successfully');
    }

    /**
     * the restoreOperation function to return operation to view and add the deleted_at = null . 
     */
    public function restoreOpreation($id)
    {
        $operation=Operation::onlyTrashed()->findOrFail($id);
        $operation->restore();
        return parent::success('restore operation successfully');
    }

}
