<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GuestPassTest extends DuskTestCase
{
    protected $address_ids = [
        "Choose Address" => "Choose Address",
        "245543" => "12347 N Aragon Way",
        "245540" => "12349 N Aragon Way",
        "245545" => "12395 N Aragon Way Building Parking",
        "245544" => "12345 N Aragon Way ",
        "245577" => "12249 N Lima Way",
        "245576" => "12251 N Lima Way",
        "245575" => "12253 N Lima Way",
        "245574" => "12255 N Lima Way",
        "245573" => "12257 N Lima Way",
        "245572" => "12259 N Lima Way",
        "245571" => "12261 N Lima Way",
        "245569" => "12265 N Lima Way",
        "245570" => "12263 N Lima Way ",
        "245561" => "14906 N Navarre Way ",
        "245539" => "12344 N Villar Way",
        "245538" => "12346 N Villar Way",
        "245537" => "12348 N Villar  Way",
        "245535" => "12350 N Villar Way",
        "245858" => "00000 Test Avenue",
        "245616" => "14830 W Castille Way",
        "245615" => "14832 W Castille Way",
        "245614" => "14834 W Castille Way",
        "245612" => "14836 W Castille Way",
        "245546" => "14837 W Castille Way",
        "245611" => "14838 W Castille Way",
        "245605" => "14839 W Castille Way",
        "245610" => "14840 W Castille Way",
        "245604" => "14841 W Castille Way",
        "245609" => "14842 W Castille Way",
        "245608" => "14844 W Castille Way",
        "245601" => "14845 W Castille Way",
        "245607" => "14846 W Castille Way",
        "245600" => "14847 W Castille Way",
        "245606" => "14848 W Castille Way",
        "245599" => "14849 W Castille Way",
        "245598" => "14850 W Castille Way",
        "245588" => "14851 W Castille Way",
        "245597" => "14852 W Castille Way",
        "245596" => "14854 W Castille Way",
        "245586" => "14855 W Castille  Way",
        "245595" => "14856 W Castille Way",
        "245594" => "14900 W Castille Way",
        "245593" => "14902 W Castille Way",
        "245592" => "14904 W Castille Way",
        "245583" => "14905 W Castille Way",
        "245591" => "14906 W Castille  Way",
        "245581" => "14907 W Castille Way",
        "245590" => "14908 W Castille Way",
        "245589" => "14910 W Castille Way",
        "245603" => "14843 W Castille Way ",
        "245587" => "14853 W Castille Way ",
        "245584" => "14903 W Castille Way ",
        "245526" => "14853  W Navarre  Way",
        "245527" => "14855 W Navarre Way",
        "245528" => "14857 W Navarre Way",
        "245533" => "14863 W Navarre Way",
        "245534" => "14865  W Navarre Way",
        "245547" => "14901 W Navarre Way",
        "245548" => "14903 W Navarre Way",
        "245562" => "14904 W Navarre Way",
        "245549" => "14905 W Navarre Way",
        "245550" => "14907 W Navarre Way",
        "245560" => "14908 W Navarre Way",
        "245551" => "14909 W Navarre Way",
        "245559" => "14910 W Navarre Way",
        "245552" => "14911 W Navarre Way",
        "245558" => "14912 W Navarre Way",
        "245557" => "14914 W Navarre Way",
        "245553" => "14915 W Navarre Way",
        "245556" => "14916 W Navarre Way",
        "245554" => "14917 W Navarre Way",
        "245555" => "14918 W Navarre Way",
        "245564" => "14919 W Navarre Way",
        "245578" => "14920 W Navarre Way",
        "245566" => "14923 W Navarre Way",
        "245580" => "14924 W Navarre Way",
        "245567" => "14925 W Navarre Way",
        "245568" => "14927 W Navarre Way",
        "245525" => "14851 W Navarre Way ",
        "245530" => "14859 W Navarre Way ",
        "245531" => "14861 W Navarre Way ",
        "245563" => "14902 W Navarre Way ",
        "245565" => "14921 W Navarre Way ",
        "245579" => "14922 W Navarre Way ",
        "245585" => "14901 W. Castille Way",
        "248466" => "14913 W. Navarre Way",
    ];

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
            //$this->completeStep3($browser);
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
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyAddressIDFK', array_search('14905 W Navarre Way', $this->address_ids))
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
                ->assertInputValue('ctl00$ContentPlaceHolder1$Wizard1$FinishNavigationTemplateContainerID$FinishButton', 'Finish');
    }

    /**
     * @return void
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

        Browser::macro('selectSecondOption', function ($element = null) {
            $this->script("$('select[name=\"{$element}\"] option:eq(1)').attr('selected', 'selected');");
            return $this;
        });

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
            ->press('ctl00$ContentPlaceHolder1$Wizard1$StartNavigationTemplateContainerID$StartNextButton');
    }
}
