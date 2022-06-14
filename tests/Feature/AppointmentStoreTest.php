<?php

namespace Tests\Feature;

use App\Events\AppointmentRegistered;
use App\Listeners\SendEmailNotification;
use App\Models\Appointment;
use App\Notifications\AppointmentRegisteredNotification;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AppointmentStoreTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testItRedirectToFormOnSuccess()
    {
        $attributes = $this->generateAttributes();
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('appointments.create'));
    }

    public function testItSaveAppointmentInDatabase()
    {
        $attributes = $this->generateAttributes();
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

    public function testItFlashSuccessMessage()
    {
        $attributes = $this->generateAttributes();
        $response = $this->post(route('appointments.store'), $attributes);
        $response->assertSessionHas('success');
    }


    public function testItEmitAnEventOnRegister()
    {
        Event::fake(AppointmentRegistered::class);
        $attributes = $this->generateAttributes();
        $this->post(route('appointments.store'), $attributes);
        Event::assertDispatched(AppointmentRegistered::class);

    }

    public function testItSendANotificationtOnRegister()
    {
        Notification::fake();
        $attributes = $this->generateAttributes();
        $this->post(route('appointments.store'), $attributes);
        Notification::assertSentTo(
            new AnonymousNotifiable,
            AppointmentRegisteredNotification::class,
            function ($notification, $channels, $notifiable) use ($attributes) {
                return $notifiable->routes['mail'] === $attributes['email'];
            }
        );
    }


    protected function generateAttributes()
    {
        $attributes = factory(Appointment::class)->make()->toArray();
        $attributes['schedule_at'] = (new Carbon($attributes['schedule_at']))->format('d/m/Y H:i');
        return $attributes;
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
