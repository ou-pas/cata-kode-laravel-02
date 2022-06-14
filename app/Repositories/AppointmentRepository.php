<?php

namespace App\Repositories;
use App\Models\Appointment;

class AppointmentRepository
{
    public function create($attrs): Appointment
    {
        $appointment = new Appointment();
        $appointment->fill($attrs);
        $appointment->save();

        return $appointment;
    }

    public function getLast()
    {
        return Appointment::orderBy('created_at', 'DESC')->first();
    }
}
