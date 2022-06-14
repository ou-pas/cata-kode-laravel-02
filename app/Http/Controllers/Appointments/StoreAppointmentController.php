<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Repositories\AppointmentRepository;

class StoreAppointmentController extends Controller
{
    protected AppointmentRepository $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function __invoke(StoreAppointmentRequest $request)
    {
        $this->appointmentRepository->create(
            $request->only([
                'name',
                'phone',
                'email',
                'schedule_at',
                'message'
            ])
        );

        return redirect()->route('appointments.store');
    }
}
