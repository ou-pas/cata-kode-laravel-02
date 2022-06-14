<?php

namespace Tests\Feature;

use App\Models\Appointment;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentStoreTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testItRedirectToFormOnSuccess()
    {
        $attributes = factory(Appointment::class)->make()->toArray();
        $attributes['schedule_at'] = (new Carbon($attributes['schedule_at']))->format('d/m/Y H:i');
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('appointments.create'));
    }

    public function testItSaveAppointmentInDatabase()
    {
        $attributes = factory(Appointment::class)->make()->toArray();
        $attributes['schedule_at'] = (new Carbon($attributes['schedule_at']))->format('d/m/Y H:i');
        $this->post(route('appointments.store'), $attributes);
        $this->assertDatabaseHas('appointments',array_merge($attributes, [
            'schedule_at' => $this->scheduleAtAssertValue($attributes['schedule_at'])
        ]));
    }

    /**
     * @dataProvider badPhoneFormatProvider
     * @return void
     */
    public function testItReformatPhoneNumberBeforeSave($badFormat, $expected)
    {
        $attributes = factory(Appointment::class)->make([
            'phone' => $badFormat
        ])->toArray();
        $attributes['schedule_at'] = (new Carbon($attributes['schedule_at']))->format('d/m/Y H:i');
        $this->post(route('appointments.store'), $attributes);
        $this->assertDatabaseMissing('appointments',$attributes);
        $this->assertDatabaseHas('appointments',array_merge($attributes, [
            'phone' => $expected,
            'schedule_at' => $this->scheduleAtAssertValue($attributes['schedule_at'])
        ]));
    }

    protected function scheduleAtAssertValue($attribute)
    {
        return (Carbon::createFromFormat('d/m/Y H:i', $attribute))->format('Y-m-d H:i:00');
    }

    public function badPhoneFormatProvider()
    {
        return [
            'With space' => ['+33 6 00 00 00 00', '+33600000000'],
            'Without +33' => ['06 00 00 00 00', '+33600000000'],
            'With 00' => ['0033 6 00 00 00 00', '+33600000000']
        ];
    }
}
