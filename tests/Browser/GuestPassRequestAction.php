<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Throwable;

class GuestPassRequestAction extends DuskTestCase
{
    use GuestPass;

    /**
     * Get a new guest parking pass
     *
     * @throws Throwable
     * @test
     * @group ignore
     */
    public function requestGuestPass()
    {
        $person = strtolower(env('REQUEST_GUEST_PASS_PERSON'));
        $personVehicles = (object) json_decode($this->getPersonVehicleConfig(), true);

        if(!isset($personVehicles->$person)){
            throw new \Exception("Unknown person {$person}");
        }

        $personVehicle = (object) $personVehicles->$person;
        $vehicle = (object) $personVehicle->vehicle;

        print("\n\nRequesting Pass For\n-------------------------------------------\n");
        print_r($personVehicle);

        $guestVehicle = new GuestVehicle();
        $guestVehicle->licensePlate = $vehicle->licensePlate;
        $guestVehicle->make = $vehicle->make;
        $guestVehicle->model = $vehicle->model;
        $guestVehicle->color = $vehicle->color;

        $this->request($this->getPropertyAddress(), $this->getContact(), $guestVehicle);
    }

}
