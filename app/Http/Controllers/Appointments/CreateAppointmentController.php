<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateAppointmentController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('welcome');
    }
}
