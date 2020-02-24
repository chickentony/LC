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
        $I->wantTo('Test authorization into admin panel');
        $I->amOnPage($authorizationWindow::PAGE_URL);
        $authorizationWindow->login(getenv('ADMIN_LOGIN'), getenv('ADMIN_PASSWORD'));
        $I->see('You are now logged in as admin');
    }

    public function failedAuthorization(AcceptanceTester $I, AuthorizationWindow $authorizationWindow): void
    {
        $I->wantTo('Test login with invalid params should not login user into admin panel');
        $I->amOnPage($authorizationWindow::PAGE_URL);
        $authorizationWindow->login('lox', '123');
        $I->waitForText('The user could not be found in our database');
    }
}