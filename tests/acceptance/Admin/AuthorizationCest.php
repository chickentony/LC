<?php

declare(strict_types=1);

namespace Tests\acceptance\Admin;

use AcceptanceTester;
use Tests\Page\Admin\AuthorizationWindow;

class AuthorizationCest
{
    /**
     * @param AcceptanceTester $I
     * @param AuthorizationWindow $authorizationWindow
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function successAuthorization(AcceptanceTester $I, AuthorizationWindow $authorizationWindow): void
    {
        $login = getenv('ADMIN_LOGIN');
        $password = getenv('ADMIN_PASSWORD');

        $I->wantTo('Test authorization into admin panel');
        $I->amOnPage($authorizationWindow::PAGE_URL);
        $authorizationWindow->login($login, $password);
        $I->see('You are now logged in as admin');
    }

    /**
     * @param AcceptanceTester $I
     * @param AuthorizationWindow $authorizationWindow
     * @throws \Exception
     */
    public function loginByNonExistentUser(AcceptanceTester $I, AuthorizationWindow $authorizationWindow): void
    {
        $I->wantTo('Test login with non existent params should not login user into admin panel');
        $I->amOnPage($authorizationWindow::PAGE_URL);
        $authorizationWindow->login('test', '123');
        $I->waitForText('The user could not be found in our database');
    }
}