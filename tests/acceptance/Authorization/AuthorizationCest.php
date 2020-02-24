<?php

namespace Tests\acceptance\Authorization;

use AcceptanceTester;
use Codeception\Example;
use Tests\Page\Main\MainPage;

class AuthorizationCest
{
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
        $mainPage->login(getenv('USER_EMAIL'), getenv('USER_PASSWORD'));
        $I->see('You are now logged in as Антон Миролюбов.');
    }

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @param Example $example
     * @throws \Codeception\Exception\ModuleException
     * @dataProvider wrongLoginParamsDataProvider
     */
    public function authorizationWithWrongParams(AcceptanceTester $I, MainPage $mainPage, Example $example)
    {
        $I->wantTo('Check login with wrong params should not login user');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login($example['login'], $example['password']);
        $I->see('Wrong password or the account is disabled, or does not exist');
    }

    /**
     * @return array
     */
    private function wrongLoginParamsDataProvider()
    {
        return [
            'wrongPassword' => [
                'login' => getenv('USER_EMAIL'),
                'password' => 12345
            ],
            'wrongLogin' => [
                'login' => 'some_string',
                'password' => getenv('USER_PASSWORD')
            ],
            'notRegistratedUser' => [
                'login' => 'user1@test.ru',
                'password' => 12345
            ]
        ];
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
        $mainPage->login(getenv('USER_EMAIL'), '');
        $I->see('You must provide both email address and password.');
    }
}