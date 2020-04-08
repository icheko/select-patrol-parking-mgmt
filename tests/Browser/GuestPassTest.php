<?php

namespace Tests\Browser;

use Illuminate\Support\Str;
use PHPUnit\Framework\Assert as PHPUnit;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GuestPassTest extends DuskTestCase
{
    use GuestPass;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testGuestParkingPassButtonVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Temporary parking pass for your guests.')
                ->assertSee('Guest Parking Pass');
        });
    }

    /**
     * @throws \Throwable
     * @test
     */
    public function registerGuestPass(){
        $contact = new PersonContact();
        $contact->first_name = 'Jose';
        $contact->last_name = 'Pacheco';
        $contact->email = 'icheko@gmail.com';
        $contact->phone = '8186758615';

        $vehicle = new GuestVehicle();
        $vehicle->licensePlate = '6NGZ173';
        $vehicle->make = 'Toyota';
        $vehicle->model = 'Corolla';
        $vehicle->color = 'Gray';

        $this->register('14905 W Navarre Way', $contact, $vehicle);
    }
}
