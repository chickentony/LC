<?php

namespace Tests\acceptance\Authorization;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class AuthorizationCest
{
    private $login = 'miroliubov.a@yandex.ru';
    private $password = '09764227';

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Exception
     */
    public function successAuthorization(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->wantTo('Check success authorization');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login($this->login, $this->password);
        $I->see('You are now logged in as Антон Миролюбов.');
    }

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function authorizationWithIncorrectPassword(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->wantTo('Check login with wrong password should not login user');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login($this->login, '12345');
        $I->see('Wrong password or the account is disabled, or does not exist');
    }

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function authorizationWithoutPassword(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->wantTo('Check login without password should not login user');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login($this->login, '');
        $I->see('You must provide both email address and password.');
    }
}