<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Throwable;

class GuestPassRegisterAction extends DuskTestCase
{
    use GuestPass;

    /**
     * List of known vehicles
     */
    private array $personVehicles = [
        "dena" => [
            "person" => [
                "first_name" => "Dena",
                "last_name" => "Betancourt"
            ],
            "vehicle" => [
                "licensePlate" => "6NGZ173",
                "make" => "Toyota",
                "model" => "Corolla",
                "color" => "Gray",
            ],
        ],
    ];

    /**
     * The individual to contact in case of emergency
     */
    private PersonContact $contact;

    /**
     * The address to look up account
     */
    private string $address = '14905 W Navarre Way';

    /**
     * Before test case is called
     */
    protected function setUp(): void
    {
        $contact = new PersonContact();
        $contact->first_name = 'Jose';
        $contact->last_name = 'Pacheco';
        $contact->email = 'icheko@gmail.com';
        $contact->phone = '8186758615';

        $this->contact = $contact;

        parent::setUp();
    }

    /**
     * Get a new guest parking pass
     *
     * @throws Throwable
     * @test
     * @group ignore
     */
    public function registerGuestPass()
    {
        $person = strtolower(env('REGISTER_GUEST_PASS_PERSON'));
        $personVehicles = json_decode(json_encode($this->personVehicles, true));

        if(!isset($personVehicles->$person)){
            throw new \Exception("Unknown person {$person}");
        }

        $personVehicle = $personVehicles->$person;

        print("\n\nRegistering\n-------------------------------------------\n");
        print_r($personVehicle);

        $vehicle = new GuestVehicle();
        $vehicle->licensePlate = $personVehicle->vehicle->licensePlate;
        $vehicle->make = $personVehicle->vehicle->make;
        $vehicle->model = $personVehicle->vehicle->model;
        $vehicle->color = $personVehicle->vehicle->color;

        $this->register($this->address, $this->contact, $vehicle);
    }

}
