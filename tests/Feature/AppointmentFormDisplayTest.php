<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppointmentFormDisplayTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItDisplayForm()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('appointments.create'));
        $response->assertStatus(200);
        $response->assertSee('<input id="name', false);
        $response->assertSee('<input id="phone', false);
        $response->assertSee('<input id="email', false);
        $response->assertSee('<input id="schedule_at', false);
        $response->assertSee('<input id="message', false);

    }
}
