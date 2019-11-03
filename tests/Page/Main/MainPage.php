<?php

namespace Tests\Page\Main;

use AcceptanceTester;

class MainPage extends AcceptanceTester
{
    const MAIN_PAGE_URL = '/';

    const LOGO_DIV = '//*[@id="logotype-wrapper"]';

    const EMAIL_INPUT = '//table//input[contains(@name, "email")]';

    const PASSWORD_INPUT = '//table//input[contains(@name, "password")]';

    const LOGIN_BUTTON = '//table//button[contains(@name, "login")]';

    /**
     * @param $login string
     * @param $password string
     */
    public function login($login, $password)
    {
        $this->fillField(self::EMAIL_INPUT, $login);
        $this->fillField(self::PASSWORD_INPUT, $password);
        $this->click(self::LOGIN_BUTTON);
    }

}