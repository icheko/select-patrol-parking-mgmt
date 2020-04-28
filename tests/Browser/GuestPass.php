<?php

namespace Tests\Browser;

use Exception;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Laravel\Dusk\Chrome\SupportsChrome;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Throwable;

trait GuestPass
{
    use ProvidesBrowser,
        SupportsChrome;

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
     *
     */
    public function addMacros(){
        Browser::macro('selectSecondOption', function ($element = null) {
            $this->script("$('select[name=\"{$element}\"] option:eq(1)').attr('selected', 'selected');");
            return $this;
        });
    }

    /**
     * Request a new guest parking pass
     *
     * @param String $address
     * @param PersonContact $personContact
     * @param GuestVehicle $guestVehicle
     * @param bool $test
     * @return void
     * @throws Throwable
     */
    public function request(String $address, PersonContact $personContact, GuestVehicle $guestVehicle)
    {
        $this->addMacros();
        $this->browse(function (Browser $browser) use ($address, $personContact, $guestVehicle) {
            $this->completeStep1($browser, $address);
            $this->completeStep2($browser, $personContact);
            $this->completeStep3($browser, $guestVehicle);
        });
    }

    /**
     * @param $browser
     * @param $address
     */
    public function completeStep1($browser, $address){
        $browser->visit('/')
            ->click('a[href$="TEMPORARYPERMIT"]')
            ->assertSee('Step 1 - Your Location')
            ->type('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$stxtPropertyName', 'cabrillo')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scmdFind')
            ->waitForText('Choose Property')
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyIDFK', '62399')
            ->waitForText('Choose Address')
            ->select('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboPropertyAddressIDFK', array_search($address, $this->address_ids))
            ->waitForText('Choose Unit Number')
            ->selectSecondOption('ctl00$ContentPlaceHolder1$Wizard1$WucUnitSelector1$scboUnitIDFK')
            ->press('ctl00$ContentPlaceHolder1$Wizard1$StartNavigationTemplateContainerID$StartNextButton')
            ->waitForText('If you do not fill out your email address');
    }

    /**
     * @param $browser
     * @param PersonContact $personContact
     * @throws Exception
     */
    public function completeStep2($browser, PersonContact $personContact){
        $browser->assertSee('If you do not fill out your email address')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtFirstName', $personContact->first_name)
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtLastName', $personContact->last_name)
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$wucPhone$stxtPhone', $personContact->phone)
                ->type('ctl00$ContentPlaceHolder1$Wizard1$WucContactInfo1$stxtEmailAddress', $personContact->email)
                ->press('ctl00$ContentPlaceHolder1$Wizard1$StepNavigationTemplateContainerID$StepNextButton');

        if($error = $this->isStep2Error($browser))
            throw new Exception($error);
    }

    /**
     * @param $browser
     */
    public function completeStep3($browser, GuestVehicle $guestVehicle){
        $browser->assertSee('Guest Vehicle Information')
                ->type('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$stxtLicensePlate', $guestVehicle->licensePlate)
                ->select('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$scboVehicleMake', $guestVehicle->make)
                ->type('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$stxtVehicleModel', $guestVehicle->model)
                ->select('ctl00$ContentPlaceHolder1$Wizard1$wucVehicleInfo1$scboVehicleColor', $guestVehicle->color);
                //->assertInputValue('ctl00$ContentPlaceHolder1$Wizard1$FinishNavigationTemplateContainerID$FinishButton', 'Finish');
    }

    /**
     * @param $browser
     * @return bool
     */
    public function isStep2Error($browser){
        $selector = '#ContentPlaceHolder1_Wizard1_lblNoMatch';
        try {
            $error = $browser->text($selector);
        }catch(NoSuchElementException $exception){
            $error = '';
        }

        if($error == '')
            return false;

        return $error;
    }

    /**
     * @return string
     */
    public function getPersonVehicleConfig(){
        return config('services.select-patrol.person-vehicle-config');
    }

    /**
     * @return string
     */
    public function getPropertyAddress(){
        return config('services.select-patrol.property-address');
    }

    /**
     * @return PersonContact
     */
    public function getContact()
    {
        $contact = new PersonContact();
        $contact->first_name = config('services.select-patrol.contact-first-name');
        $contact->last_name = config('services.select-patrol.contact-last-name');
        $contact->email = config('services.select-patrol.contact-email');
        $contact->phone = config('services.select-patrol.contact-phone');

        return $contact;
    }
}
