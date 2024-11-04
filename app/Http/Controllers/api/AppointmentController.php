<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\appointment\StoreAppointmentRequest;
use App\Http\Requests\appointment\UpdateAppointmentRequest;
use Illuminate\Http\JsonResponse;
use App\models\Appointment;

class AppointmentController extends Controller
{

    /**
     * this function get all appintment from database and cheek if status active or unactive.
     * added simplePaginate to fetch data to one page ,page numbering and link.
     */
    public function index()
    {
        $appointment=Appointment::where('status','active')->simplePaginate(10);
        $data=$appointment->map(function($p){
            return[
                'id'=>$p->id,
                'doctor'=>$p->users['name'],
                'patient'=>$p->patients['firstName'].' '.$p->patients['lastName'],
                'details'=>$p->details,
                'startDate'=>$p->startDate,
                'endDate'=>$p->endDate
            ];
        });
        return parent::success($data);
    }

    /**
     * this function uplode data to database to appointments.
     * it depends on sending the request and verifying it via StoreAppointmentRequest
     */
    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $validation=$request->validated();

        $appointment=Appointment::create($request->all());

        return parent::success($appointment);
    }

    /**
     * this function update the appointment any column in database
     * it depends on sending the request and verifying it via UpdateAppointmentRequest
     */
    public function update(UpdateAppointmentRequest $request,$id) : JsonResponse
    {
        $appointment=Appointment::findOrFail($id);
        $validation=$request->validated();
        $appointment->update($validation);
        $messages='update successfully';

        return parent::success($messages);
    }
    /**
     * this function return one appointment about id
     */
    public function getAppointment(Request $request)
    {
        $appointment=Appointment::where('id',$request->id)->where('status','active')->get();

        $data=$appointment->map(function($p){
            return[
                'doctor' =>$p->users['name'],
                'patient' =>$p->patients['firstName'].' '.$p->patients['lastName'],
                'details'=>$p->details,
                'startDate'=>$p->startDate,
                'endDate'=>$p->endDate,
            ];
        });
            return parent::success($data);

    }

    /**
     * this function update status from active to unactive.
     * it changes the state every time it is called.
     */

    public function updateStatus($id)
    {
        $appointment=Appointment::find($id);
        if($appointment->status === 'active')
        {
            $appointment->status ='unactive';

        }else
        {
            $appointment->status='active';
        }

        $appointment->update();
        return parent::success('update stusas successfully');
    }

    /**
     * this function delete appointment.
     * here use softDelete
     */
    public function delete($id)
    {
        $appointment=Appointment::findOrFail($id);
        $appointment->delete();
        return parent::success('deleted successfully');
    }

    /**
     * this function to return the appointment from delete
     */
    public function restoreAppointment($id)
    {
        $appointment=Appointment::onlyTrashed()->findOrFail($id);
        $appointment->restore();
        return parent::success($appointment);

    }
}
