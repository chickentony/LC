<?php

namespace Tests\Page\Main;

use AcceptanceTester;

class MainPage
{
    public const MAIN_PAGE_URL = '/';

    public const LOGO_DIV = '//*[@id="logotype-wrapper"]';

    public const EMAIL_INPUT = '//table//input[contains(@name, "email")]';

    public const PASSWORD_INPUT = '//table//input[contains(@name, "password")]';

    public const LOGIN_BUTTON = '//table//button[contains(@name, "login")]';

    public const CAMPAIGN_FIRST_ITEM = '//div[@id="box-campaigns"]//a[@class="link"]';

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    protected $tester;

    /**
     * @param $login string
     * @param $password string
     */
    public function login($login, $password)
    {
        $this->tester->fillField(self::EMAIL_INPUT, $login);
        $this->tester->fillField(self::PASSWORD_INPUT, $password);
        $this->tester->click(self::LOGIN_BUTTON);
    }

}