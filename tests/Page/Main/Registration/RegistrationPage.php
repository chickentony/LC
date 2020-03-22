<?php

declare(strict_types=1);

namespace Tests\Page\Main\Registration;

use AcceptanceTester;

class RegistrationPage
{
    /** @var array Массив букв для генерации почты */
    public $letters = [
        'a', 'b', 'c', 'd', 'e', 'f', 'j', 'h', 'i', 'g', 'k', 'l', 'm', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w'
    ];

    /** @var array Массив с информацией о новом пользователе */
    public const NEW_USER = [
        'NAME' => 'Фредд',
        'LAST_NAME' => 'Дерст'
    ];

    /** @var string Строука с почтой */
    public $generatedEmail;

    /** @var array Массив с обязательными полями ввода информации о пользователи */
    public const REQUIRED_CUSTOMER_INFO_FIELDS = [
        'FIRST_NAME_INPUT' => '//*[@name="firstname"]',
        'LAST_NAME_INPUT' => '//*[@name="lastname"]',
        'FIRST_ADDRESS_INPUT' => '//*[@name="address1"]',
        'POST_CODE_INPUT' => '//*[@name="postcode"]',
        'CITY_INPUT' => '//*[@name="city"]',
        'EMAIL_INPUT' => '//*[@name="email"]',
        'PHONE_INPUT' => '//*[@name="phone"]',
        'PASSWORD_INPUT' => '//*[@name="password"]',
        'CONFIRM_PASSWORD_INPUT' => '//*[@name="confirmed_password"]',
        'NEWSLETTER_CHECKBOX' => '//*[@name="newsletter"]',
        'CREATE_ACCOUNT_BUTTON' => '//*[@name="create_account"]',
    ];

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * RegistrationPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /** Регистрирует нового пользователя
     * @throws \Exception
     */
    public function newCustomerRegistration(): void
    {
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['FIRST_NAME_INPUT'], self::NEW_USER['NAME']);
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['LAST_NAME_INPUT'], self::NEW_USER['LAST_NAME']);
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['FIRST_ADDRESS_INPUT'], 'Джексонвилл, Техас');
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['POST_CODE_INPUT'], '127425');
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['CITY_INPUT'], 'Техас');
        $this->setEmail($this->letters, 4);
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['EMAIL_INPUT'], $this->generatedEmail);
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['PHONE_INPUT'], '81234567890');
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['PASSWORD_INPUT'], '123qwe');
        $this->tester->fillField(self::REQUIRED_CUSTOMER_INFO_FIELDS['CONFIRM_PASSWORD_INPUT'], '123qwe');
        $this->tester->uncheckOption(self::REQUIRED_CUSTOMER_INFO_FIELDS['NEWSLETTER_CHECKBOX']);
        $this->tester->click(self::REQUIRED_CUSTOMER_INFO_FIELDS['CREATE_ACCOUNT_BUTTON']);
    }

    /**
     * @param $letters
     * @param int $num
     * Задаем email пользователя
     * @throws \Exception
     */
    private function setEmail($letters, $num = 1): void
    {
        shuffle($letters);
        $result = [];
        for ($i = 0; $i < $num; $i++) {
            $result[] = $letters[$i];
        }
        $emailString = implode($result);
        $randomNum = random_int(1000, 10000);
        $this->generatedEmail = "{$emailString}{$randomNum}@test.ru";
    }
}