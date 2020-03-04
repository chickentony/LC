<?php

declare(strict_types=1);

namespace Step\Acceptance;

use AcceptanceTester;
use Facebook\WebDriver\Exception\WebDriverException;
use Tests\Page\Admin\AuthorizationWindow;

class Admin extends AcceptanceTester
{
    /** Логинется в админку под админом */
    public function loginAsAdmin(): void
    {
        $authorizationWindow = new AuthorizationWindow($this);
        $login = getenv('ADMIN_LOGIN');
        $password = getenv('ADMIN_PASSWORD');
        $this->amOnPage($authorizationWindow::PAGE_URL);
        try {
            $this->fillField($authorizationWindow::USERNAME_INPUT, $login);
            $this->fillField($authorizationWindow::PASSWORD_INPUT, $password);
            $this->click($authorizationWindow::LOGIN_BUTTON);
        } catch (WebDriverException $e) {
            $e->getMessage();
        }
    }
}
