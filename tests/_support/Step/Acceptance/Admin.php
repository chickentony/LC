<?php

namespace Step\Acceptance;

use AcceptanceTester;
use Facebook\WebDriver\Exception\WebDriverException;
use Tests\Page\Admin\AuthorizationWindow;

class Admin extends AcceptanceTester
{
    public function loginAsAdmin()
    {
        $authorizationWindow = new AuthorizationWindow($this);
        $this->amOnPage($authorizationWindow::PAGE_URL);
        try {
            $this->fillField($authorizationWindow::USERNAME_INPUT, getenv('ADMIN_LOGIN'));
            $this->fillField($authorizationWindow::PASSWORD_INPUT, getenv('ADMIN_PASSWORD'));
            $this->click($authorizationWindow::LOGIN_BUTTON);
        } catch (WebDriverException $e) {
            $e->getMessage();
        }
    }
}
