<?php

namespace App\Http\Controllers\Appointments;

use App\Events\AppointmentRegistered;
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

        try {
            $appointment = $this->appointmentRepository->create(
                $request->only([
                    'name',
                    'phone',
                    'email',
                    'schedule_at',
                    'message'
                ])
            );

        } catch (\Exception $exception){
            return redirect()
                ->route('appointments.store')
                ->with('error', 'appointment.error');
        }

        event(new AppointmentRegistered($appointment));

        return redirect()
            ->route('appointments.store')
            ->with('success', 'appointment.saved');
    }
}
