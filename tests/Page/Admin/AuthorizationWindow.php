<?php

namespace Tests\Page\Admin;

use AcceptanceTester;

class AuthorizationWindow
{
    public const PAGE_URL = '/admin';

    public const USERNAME_INPUT = '//*[@name="username"]';

    public const PASSWORD_INPUT = '//*[@name="password"]';

    public const LOGIN_BUTTON = '//*[@name="login"]';

    protected $tester;

    /**
     * AuthorizationWindow constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @param string $login
     * @param string $password
     * @throws \Exception
     */
    public function login(string $login, string $password)
    {
        $this->tester->waitForElementVisible(self::USERNAME_INPUT);
        $this->tester->fillField(self::USERNAME_INPUT, $login);
        $this->tester->waitForElementVisible(self::PASSWORD_INPUT);
        $this->tester->fillField(self::PASSWORD_INPUT, $password);
        $this->tester->click(self::LOGIN_BUTTON);
    }
}