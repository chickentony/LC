<?php

namespace Tests\Page\Main\Campaign;

use AcceptanceTester;

class CampaignPage
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