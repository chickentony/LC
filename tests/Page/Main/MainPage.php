<?php

namespace Tests\Page\Main;

use AcceptanceTester;

class MainPage
{
    /** @var array Массив свойст обычной цены */
    public $regularPriceCssProperties = [
        'fontSize' => '',
        'color' => '',
        'textDecoration' => ''
    ];

    /** @var array Массив свойст скидочной цены */
    public $campaignPriceCssProperties = [
        'fontSize' => '',
        'color' => '',
        'textDecoration' => ''
    ];

    /** @var string Элемент с обычной ценой */
    public const REGULAR_PRICE = '//div[@id="box-campaigns"]//s[@class="regular-price"]';

    /** @var string Элемент со скидочной ценой */
    public const CAMPAIGN_PRICE = '//div[@id="box-campaigns"]//strong[@class="campaign-price"]';

    /** @var string URL главной страницы */
    public const MAIN_PAGE_URL = '/';

    /** @var string Логотип на главной странице */
    public const LOGO_DIV = '//*[@id="logotype-wrapper"]';

    /** @var string Поле для ввода почты */
    public const EMAIL_INPUT = '//table//input[contains(@name, "email")]';

    /** @var string Поле для ввода пароля */
    public const PASSWORD_INPUT = '//table//input[contains(@name, "password")]';

    /** @var string Кнопка логина */
    public const LOGIN_BUTTON = '//table//button[contains(@name, "login")]';

    /** @var string Первый акционный элемент */
    public const CAMPAIGN_FIRST_ITEM = '//div[@id="box-campaigns"]//a[@class="link"]';

    /**
     * MainPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * Авторизация пользователя
     * @param $login string
     * @param $password string
     */
    public function login($login, $password)
    {
        $this->tester->fillField(self::EMAIL_INPUT, $login);
        $this->tester->fillField(self::PASSWORD_INPUT, $password);
        $this->tester->click(self::LOGIN_BUTTON);
    }

    /**
     * Получает css свойства обычной цены
     * @throws \Codeception\Exception\ModuleException
     */
    public function getRegularPriceCssProperties()
    {
        $this->regularPriceCssProperties['fontSize'] = $this->tester->
        getCssProperty(self::REGULAR_PRICE, 'font-size');
        $this->regularPriceCssProperties['color'] = $this->tester->
        getCssProperty(self::REGULAR_PRICE, 'color');
        $this->regularPriceCssProperties['textDecoration'] = $this->tester->
        getCssProperty(self::REGULAR_PRICE, 'text-decoration');
    }

    /**
     * Получает свойства скидочной цены
     * @throws \Codeception\Exception\ModuleException
     */
    public function getCampaignPriceCssProperties()
    {
        $this->campaignPriceCssProperties['fontSize'] = $this->tester->
        getCssProperty(self::CAMPAIGN_PRICE, 'font-size');
        $this->campaignPriceCssProperties['color'] = $this->tester->
        getCssProperty(self::CAMPAIGN_PRICE, 'color');
        $this->campaignPriceCssProperties['textDecoration'] = $this->tester->
        getCssProperty(self::CAMPAIGN_PRICE, 'text-decoration');
    }

}