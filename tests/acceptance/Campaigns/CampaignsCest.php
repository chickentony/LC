<?php

namespace Tests\acceptance\Campaigns;

use Tests\Page\Main\MainPage;
use AcceptanceTester;

class CampaignsCest
{
    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkThatOpenCorrectProductPage(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->click($mainPage::CAMPAIGN_FIRST_ITEM);
        $I->see('RD001');
        $I->see('Yellow Duck');
    }
}