<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;

class StoreAppointmentController extends Controller
{
    public function __invoke(StoreAppointmentRequest $request)
    {
        return redirect()->route('appointments.store');
    }
}
