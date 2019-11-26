<?php

namespace Tests\acceptance\Registration;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class RegistrationCest
{
    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function newUserRegistration(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->click($mainPage::REGISTRATION_LINK);
        $mainPage->registrationPage->createAccount();
    }

}