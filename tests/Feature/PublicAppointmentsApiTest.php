<?php

namespace Tests\Feature;

use App\Models\Appointment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PublicAppointmentsApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItDisplayForm()
    {

        factory(Appointment::class, 5)->create();
        $response = $this->json('get', route('api.appointments.index'));
        $response->assertOk();
        $response->assertJsonCount(5, 'data');
    }
}
