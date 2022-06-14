<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Repositories\AppointmentRepository;

class LastAppointmentController extends Controller
{
    protected AppointmentRepository $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function __invoke()
    {
        $appointment = $this->appointmentRepository->getLast();
        return view('appointments.last', compact('appointment'));
    }
}
