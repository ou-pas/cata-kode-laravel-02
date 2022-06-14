<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreAppointmentController extends Controller
{
    public function __invoke(Request $request)
    {
        return redirect()->route('appointments.store');
    }
}
