<?php

namespace Tests\Page\Main;

use AcceptanceTester;
use Tests\Page\Main\Categories\CategoryPage;
use Tests\Page\Main\Registration\RegistrationPage;

class MainPage
{
    /** @var array Массив свойст обычной цены */
    public $regularPriceCssProperties = [
        'font-size' => '',
        'color' => '',
        'text-decoration' => ''
    ];

    /** @var array Массив свойст скидочной цены */
    public $campaignPriceCssProperties = [
        'font-size' => '',
        'color' => '',
        'text-decoration' => ''
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

    /** @var string Ссылка на страницу регистрации */
    public const REGISTRATION_LINK = '//form[@name="login_form"]//table//a';

    /** @var string Ссылка на разлогин пользователя */
    public const LOGOUT_LINK = '//li//a[text()="Logout"]';

    public const CATEGORY_LINK = '//div[@id="box-category-tree" ]//a';

    public const HOME_ICON = '//*[@title="Home"]';

    /**
     * MainPage constructor.
     * @param AcceptanceTester $tester
     * @param RegistrationPage $registrationPage
     * @param CategoryPage $categoryPage
     */
    public function __construct(AcceptanceTester $tester,
                                RegistrationPage $registrationPage,
                                CategoryPage $categoryPage
    )
    {
        $this->tester = $tester;
        $this->registrationPage = $registrationPage;
        $this->categoryPage = $categoryPage;
    }

    /** @var AcceptanceTester */
    protected $tester;

    /** @var RegistrationPage */
    public $registrationPage;

    public $categoryPage;

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

    /** Выход пользователя из акаунта */
    public function logout()
    {
        $this->tester->click(self::LOGOUT_LINK);
    }

    /**
     * Получает css свойства обычной цены
     * @throws \Codeception\Exception\ModuleException
     */
    public function getRegularPriceCssProperties()
    {
        foreach ($this->regularPriceCssProperties as $k => $v) {
            $this->regularPriceCssProperties[$k] = $this->tester->getCssProperty(self::REGULAR_PRICE, $k);
        }
    }

    /**
     * Получает свойства скидочной цены
     * @throws \Codeception\Exception\ModuleException
     */
    public function getCampaignPriceCssProperties()
    {
        foreach ($this->campaignPriceCssProperties as $k => $v) {
            $this->campaignPriceCssProperties[$k] = $this->tester->getCssProperty(self::CAMPAIGN_PRICE, $k);
        }
    }

    public function clickOnCategoryLink($category)
    {
        $this->tester->waitForElementVisible($category);
        $this->tester->click($category);
    }
}