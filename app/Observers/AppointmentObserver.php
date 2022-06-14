<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function saving(Appointment  $appointment)
    {
        $phone = str_replace(' ', '', $appointment->getAttribute('phone'));

        if(preg_match('/^0[1-9]/', $phone)){
            $phone = sprintf('+33%s', substr($phone, 1));
        }

        if(0 === strpos($phone, "0033")){
            $phone = sprintf('+%s', substr($phone, 2));
        }

        $appointment->setAttribute('phone',$phone);
    }
}
