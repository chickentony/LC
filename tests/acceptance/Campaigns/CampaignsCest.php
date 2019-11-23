<?php

namespace Tests\acceptance\Campaigns;

use Tests\Page\Main\Campaign\CampaignPage;
use Tests\Page\Main\MainPage;
use AcceptanceTester;

class CampaignsCest
{
    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @param CampaignPage $campaignPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkThatOpenCorrectProductPage(AcceptanceTester $I, MainPage $mainPage, CampaignPage $campaignPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->click($mainPage::CAMPAIGN_FIRST_ITEM);
        $I->see('RD001');
        $I->see('Yellow Duck');
        $campaignPage->getRegularPriceCssProperties();
        $I->assertTrue($campaignPage->regularPriceCssProperties['fontSize'] === '16px');
        $I->assertTrue($campaignPage->regularPriceCssProperties['color'] === 'rgba(102, 102, 102, 1)');
        $I->assertTrue($campaignPage->
            regularPriceCssProperties['textDecoration'] === 'line-through solid rgb(102, 102, 102)');

    }
}