<?php

namespace Tests\Page\Main\Campaign;

use AcceptanceTester;

class CampaignPage
{
    public $regularPriceCssProperties = [
        'fontSize' => '',
        'color' => '',
        'textDecoration' => ''
    ];

    public const REGULAR_PRICE = '//*[@class="regular-price"]';

    public const CAMPAIGN_PRICE = '//*[@class="campaign-price"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
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
        var_dump($this->regularPriceCssProperties);
    }

}