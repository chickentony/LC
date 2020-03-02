<?php

declare(strict_types=1);

namespace Tests\Page\Admin;

use AcceptanceTester;

class AuthorizationWindow
{
    /** @var string URL страницы */
    public const PAGE_URL = '/admin';

    /** @var string Инпут ввода логина */
    public const USERNAME_INPUT = '//*[@name="username"]';

    /** @var string Инпут ввода пароля */
    public const PASSWORD_INPUT = '//*[@name="password"]';

    /** @var string Кнопка авторизации */
    public const LOGIN_BUTTON = '//*[@name="login"]';

    /** @var AcceptanceTester */
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
     * Логин в админку
     */
    public function login(string $login, string $password): void
    {
        $this->tester->waitForElementVisible(self::USERNAME_INPUT);
        $this->tester->fillField(self::USERNAME_INPUT, $login);
        $this->tester->waitForElementVisible(self::PASSWORD_INPUT);
        $this->tester->fillField(self::PASSWORD_INPUT, $password);
        $this->tester->click(self::LOGIN_BUTTON);
    }
}