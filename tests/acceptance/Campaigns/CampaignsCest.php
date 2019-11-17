<?php

namespace Tests\acceptance\Campaigns;

use Tests\Page\Main\MainPage;
use AcceptanceTester;

class CampaignsCest
{
    public function checkThatOpenCorrectProductPage(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->click($mainPage::CAMPAIGN_FIRST_ITEM);
        $I->see('Yellow Duck');
    }
}