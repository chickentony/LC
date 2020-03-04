<?php

declare(strict_types=1);

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
    public function successAuthorization(AcceptanceTester $I, MainPage $mainPage): void
    {
        $login = getenv('USER_EMAIL');
        $password = getenv('USER_PASSWORD');

        $I->wantTo('Check success authorization');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login($login, $password);
        $I->see('You are now logged in as Антон Миролюбов.');
    }

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @param Example $example
     * @throws \Codeception\Exception\ModuleException
     * @dataProvider wrongLoginParamsDataProvider
     */
    public function authorizationWithWrongParams(AcceptanceTester $I, MainPage $mainPage, Example $example): void
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
    private function wrongLoginParamsDataProvider(): array
    {
        return [
            'wrongPassword' => [
                'login' => getenv('USER_EMAIL'),
                'password' => 123
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
     * @throws \Exception
     */
    public function authorizationWithoutPassword(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->wantTo('Check login without password should not login user');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->login(getenv('USER_EMAIL'), '');
        $I->see('You must provide both email address and password.');
    }
}