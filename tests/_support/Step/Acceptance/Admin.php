<?php

namespace Step\Acceptance;

use AcceptanceTester;
use Facebook\WebDriver\Exception\WebDriverException;
use Tests\Page\Admin\AuthorizationWindow;

class Admin extends AcceptanceTester
{
    public function loginAsAdmin()
    {
        $authorizationWindow = new AuthorizationWindow();
        $this->amOnPage($authorizationWindow::PAGE_URL);
        try {
            $this->fillField($authorizationWindow::USERNAME_INPUT, $authorizationWindow::USERS['adminLogin']);
            $this->fillField($authorizationWindow::PASSWORD_INPUT, $authorizationWindow::USERS['adminPassword']);
            $this->click($authorizationWindow::LOGIN_BUTTON);
        } catch (WebDriverException $e) {
            $e->getMessage();
        }
    }
}
