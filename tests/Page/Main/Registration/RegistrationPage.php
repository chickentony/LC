<?php

namespace Tests\Page\Main\Registration;

use AcceptanceTester;

class RegistrationPage
{
    public $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'j', 'h', 'i', 'g', 'k', 'l', 'm', 'o', 'p', 'r', 's', 't'];

    public $generatedEmail;

    public const FIRST_NAME_INPUT = '//*[@name="firstname"]';

    public const LAST_NAME_INPUT = '//*[@name="lastname"]';

    public const FIRST_ADDRESS_INPUT = '//*[@name="address1"]';

    public const POST_CODE_INPUT = '//*[@name="postcode"]';

    public const CITY_INPUT = '//*[@name="city"]';

    public const EMAIL_INPUT = '//*[@name="email"]';

    public const PHONE_INPUT = '//*[@name="phone"]';

    public const PASSWORD_INPUT = '//*[@name="password"]';

    public const CONFIRM_PASSWORD_INPUT = '//*[@name="confirmed_password"]';

    public const NEWSLETTER_CHECKBOX = '//*[@name="newsletter"]';

    public const CREATE_ACCOUNT_BUTTON = '//*[@name="create_account"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function createAccount()
    {
        $this->tester->fillField(self::FIRST_NAME_INPUT, 'Фредд');
        $this->tester->fillField(self::LAST_NAME_INPUT, 'Дерст');
        $this->tester->fillField(self::FIRST_ADDRESS_INPUT, 'Джексонвилл, Техас');
        $this->tester->fillField(self::POST_CODE_INPUT, '127425');
        $this->tester->fillField(self::CITY_INPUT, 'Техас');
        $this->setEmail($this->arr, 4);
        $this->tester->fillField(self::EMAIL_INPUT, $this->generatedEmail);
        $this->tester->fillField(self::PHONE_INPUT, '81234567890');
        $this->tester->fillField(self::PASSWORD_INPUT, '123qwe');
        $this->tester->fillField(self::CONFIRM_PASSWORD_INPUT, '123qwe');
        $this->tester->uncheckOption(self::NEWSLETTER_CHECKBOX);
        $this->tester->click(self::CREATE_ACCOUNT_BUTTON);
    }

    private function setEmail($letters, $num = 1)
    {
        shuffle($letters);
        $result = [];
        for ($i = 0; $i < $num; $i++) {
            $result[] = $letters[$i];
        }
        $emailString = implode($result);
        $this->generatedEmail = "{$emailString}@test.ru";
    }


}