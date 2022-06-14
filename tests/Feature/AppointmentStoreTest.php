<?php

namespace Tests\Feature;

use App\Models\Appointment;
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
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('appointments.create'));
    }
    public function testItSaveAppointementInDatabase()
    {
        $attributes = factory(Appointment::class)->make()->toArray();
        $this->post(route('appointments.store'), $attributes);
        $this->assertDatabaseHas('appointments',$attributes);
    }
}
