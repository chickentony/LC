<?php

namespace Tests\Page\Main\Campaign;

use AcceptanceTester;

class CampaignPage
{
    /** @var array Массив свойств обычной цены */
    public $regularPriceCssProperties = [
        'font-size' => '',
        'color' => '',
        'text-decoration' => ''
    ];

    /** @var array Массив свойств скидочной цены */
    public $campaignPriceCssProperties = [
        'font-size' => '',
        'color' => '',
        'text-decoration' => ''
    ];

    /** @var string Элемент с обычной ценой */
    public const REGULAR_PRICE = '//*[@class="regular-price"]';

    /** @var string Элемент со скидочной ценой */
    public const CAMPAIGN_PRICE = '//*[@class="campaign-price"]';

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * CampaignPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
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

    /**
     * Возвращает цену товара
     * @param string $locator
     * @return mixed
     */
    public function grabProductPrice(string $locator)
    {
        return $this->tester->grabTextFrom($locator);
    }

}