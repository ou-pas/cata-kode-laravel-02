<?php

namespace Tests\Feature;

use App\Models\Appointment;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentValidationTest extends TestCase
{

    use WithFaker;
    /**
     * A basic test example.
     *
     * @dataProvider requiredFieldProvider
     * @return void
     */
    public function testItReturnErrorsIsFieldIsMissing($fieldToRemove)
    {

        $attributes = factory(Appointment::class)->make()->toArray();
        unset($attributes[$fieldToRemove]);
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasErrors([
            $fieldToRemove
        ]);

    }

    /**
     * @dataProvider wrongPhoneProvider
     * @return void
     */
    public function testItReturnErrorsIsPhoneIsMalformed($wrongValue): void
    {

        $attributes = factory(Appointment::class)->make()->toArray();
        $attributes['phone'] = $wrongValue;
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasErrors([
            'phone'
        ]);

    }

    /**
     * @dataProvider wrongScheduleAtProvider
     * @return void
     */
    public function testItReturnErrorsIsScheduleAtIsMalformed($wrongValue): void
    {

        $attributes = factory(Appointment::class)->make()->toArray();
        $attributes['schedule_at'] = $wrongValue;
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasErrors([
            'schedule_at'
        ]);

    }

    public function requiredFieldProvider(): array
    {
        return [
            'field name' => [ 'name'],
            'field email' => [ 'email'],
            'field schedule_at' => [ 'schedule_at']
        ];
    }

    public function wrongPhoneProvider()
    {
        $faker = Factory::create('en_US');
        return [
            'string' => [$faker->lexify],
            'number' => [$faker->numerify('########')],
            'us phone' => [$faker->phoneNumber()]
        ];
    }

    public function wrongScheduleAtProvider()
    {
        $faker = Factory::create();

        return [
            'string' => [$faker->lexify],
            'us format' => [$faker->dateTime->format('Y-m-d H:i')]
        ];
    }
}
