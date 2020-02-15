<?php

namespace Helper;

use Codeception\Module;
use Facebook\WebDriver\Exception\WebDriverException;
use Tests\Page\Admin\AuthorizationWindow;

class LoginIntoAdminPanelHelper extends Module
{
    /**
     * @param string $login
     * @param string $password
     * @throws \Codeception\Exception\ModuleException
     */
    public function login(
        string $login = AuthorizationWindow::USERS['adminLogin'],
        string $password = AuthorizationWindow::USERS['adminPassword']
    )
    {
        $authorizationWindow = new AuthorizationWindow();
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->amOnPage($authorizationWindow::PAGE_URL);
        try {
            $webDriver->fillField($authorizationWindow::USERNAME_INPUT, $login);
            $webDriver->fillField($authorizationWindow::PASSWORD_INPUT, $password);
            $webDriver->click($authorizationWindow::LOGIN_BUTTON);
        } catch (WebDriverException $e) {
            echo $e->getMessage();
        }
    }
}