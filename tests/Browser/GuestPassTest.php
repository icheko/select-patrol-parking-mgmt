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
     * @group ignore
     */
    public function isNewGuestPassAvailable(){
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

        $this->register('14905 W Navarre Way', $contact, $vehicle, true);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testVerifyData()
    {
        $this->browse(function (Browser $browser) {
            $this->verifyStep1($browser);
        });
    }

    /**
     * @param $browser
     */
    public function verifyStep1($browser){

        $this->addMacros();

        $browser->visit('/')
            ->click('a[href$="TEMPORARYPERMIT"]')
            ->assertSee('Step 1 - Your Location')
            ->type('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$stxtPropertyName', 'cabrillo')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scmdFind')
            ->waitForText('Choose Property')
            ->assertSelectHasOptions('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyIDFK', ['62399'])
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyIDFK', '62399')
            ->waitForText('Choose Address')
            ->assertSelectHasOptions('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyAddressIDFK', array_keys($this->address_ids))
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyAddressIDFK', array_search('12347 N Aragon Way', $this->address_ids))
            ->waitForText('Choose Unit Number')
            ->selectSecondOption('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboUnitIDFK')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$StartNavigationTemplateContainerID$StartNextButton')
            ->assertSee('If you do not fill out your email address');
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testParkingPermitRegistration()
    {
        $contact = new PersonContact();
        $contact->first_name = 'Jose';
        $contact->last_name = 'Pacheco';
        $contact->email = 'icheko@gmail.com';
        $contact->phone = '8186758615';

        try {
            $this->register('12347 N Aragon Way', $contact, new GuestVehicle);
        } catch (\Exception $e) {
            $expectedMessage = 'Your information does not match what we have on file. Please try again.';
            $error = $e->getMessage();
            PHPUnit::assertTrue(
                Str::contains($error, $expectedMessage),
                "Expected exception [\"{$expectedMessage}\"] received [\"{$error}\"]."
            );
        }

    }
}
