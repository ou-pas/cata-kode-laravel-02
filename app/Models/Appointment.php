<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'schedule_at',
        'message'
    ];

    protected $dates = [
        'schedule_at'
    ];

    public function setScheduleAtAttribute($value)
    {
        if(preg_match('/\d+\/\d{2}\/\d{2}/', $value)){
            $this->attributes['schedule_at'] = Carbon::createFromFormat('d/m/Y H:i', $value);
        } else {
            $this->attributes['schedule_at'] = new Carbon($value);

        }
    }
}
