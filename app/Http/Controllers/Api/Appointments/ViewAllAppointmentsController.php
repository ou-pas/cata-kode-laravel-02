<?php

namespace App\Http\Controllers\Api\Appointments;

use App\Http\Resources\AppointmentResource;
use App\Repositories\AppointmentRepository;
use Illuminate\Routing\Controller;

class ViewAllAppointmentsController extends Controller
{
    protected AppointmentRepository $appointmentRepository;

    public function __construct(AppointmentRepository  $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function __invoke()
    {
        return AppointmentResource::collection($this->appointmentRepository->all());
    }
}
