<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GuestPassTest extends DuskTestCase
{
    /**
     * @return void
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
     * @depends testGuestParkingPassButtonVisible
     * @return void
     */
    public function testVisitStep1()
    {
        $this->browse(function (Browser $browser) {
            $browser->click('a[href$="TEMPORARYPERMIT"]')
                ->assertSee('Step 1 - Your Location');
        });
    }

    /**
     * @return void
     */
    public function testParkingPermitRegistration()
    {
        $this->browse(function (Browser $browser) {
            $this->completeStep1($browser);
            $this->completeStep2($browser);
            $this->completeStep3($browser);
        });
    }

    /**
     * @param $browser
     */
    public function completeStep1($browser){
        $browser->visit('/')
            ->click('a[href$="TEMPORARYPERMIT"]')
            ->assertSee('Step 1 - Your Location')
            ->type('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$stxtPropertyName', 'cabrillo')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scmdFind')
            ->waitForText('Choose Property')
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyIDFK', '62399')
            ->waitForText('Choose Address')
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyAddressIDFK', '245549')
            ->waitForText('Choose Unit Number')
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboUnitIDFK', '847605')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$StartNavigationTemplateContainerID$StartNextButton');
    }

    /**
     * @param $browser
     */
    public function completeStep2($browser){
        $browser->assertSee('Contact Information')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtFirstName', 'Jose')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtLastName', 'Pacheco')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$wucPhone$stxtPhone', '8186758615')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtEmailAddress', 'icheko@gmail.com')
                ->press('ctl00$ContentPlaceHolder1$Wizard1$StepNavigationTemplateContainerID$StepNextButton');
    }

    /**
     * @param $browser
     */
    public function completeStep3($browser){
        $browser->assertSee('Guest Vehicle Information')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$stxtLicensePlate', '6NGZ173')
                ->select('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$scboVehicleMake', 'Toyota')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$stxtVehicleModel', 'Corolla')
                ->select('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$scboVehicleColor', 'Gray')
                ->assertSee('Finish');
    }
}
