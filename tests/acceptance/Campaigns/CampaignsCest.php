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
        // Проверяем стили цен на главной странице
        $mainPage->getRegularPriceCssProperties();
        $I->assertTrue($mainPage->regularPriceCssProperties['fontSize'] === '14.4px');
        $I->assertTrue($mainPage->regularPriceCssProperties['color'] === 'rgba(119, 119, 119, 1)');
        $I->assertTrue($mainPage->
            regularPriceCssProperties['textDecoration'] === 'line-through solid rgb(119, 119, 119)');
        $mainPage->getCampaignPriceCssProperties();
        $I->assertTrue($mainPage->campaignPriceCssProperties['fontSize'] == '18px');
        $I->assertTrue($mainPage->campaignPriceCssProperties['color'] == 'rgba(204, 0, 0, 1)');
        $I->assertTrue($mainPage->campaignPriceCssProperties['textDecoration'] == 'none solid rgb(204, 0, 0)');
        $I->click($mainPage::CAMPAIGN_FIRST_ITEM);
        // Проверяем что открылся тот самый товар и у него корректное название
        $I->see('RD001');
        $I->see('Yellow Duck');
        //Проверям что цена указано верно
        $regularPrice = $campaignPage->grabProductPrice($campaignPage::REGULAR_PRICE);
        $I->assertTrue($regularPrice === '$20');
        $campaignPrice = $campaignPage->grabProductPrice($campaignPage::CAMPAIGN_PRICE);
        $I->assertTrue($campaignPrice === '$18');
        // Проверяем стили цен на странице акционного товара
        $campaignPage->getRegularPriceCssProperties();
        $I->assertTrue($campaignPage->regularPriceCssProperties['fontSize'] === '16px');
        $I->assertTrue($campaignPage->regularPriceCssProperties['color'] === 'rgba(102, 102, 102, 1)');
        $I->assertTrue($campaignPage->
            regularPriceCssProperties['textDecoration'] === 'line-through solid rgb(102, 102, 102)');
        $campaignPage->getCampaignPriceCssProperties();
        $I->assertTrue($campaignPage->campaignPriceCssProperties['fontSize'] === '22px');
        $I->assertTrue($campaignPage->campaignPriceCssProperties['color'] === 'rgba(204, 0, 0, 1)');
        $I->assertTrue($campaignPage->
            campaignPriceCssProperties['textDecoration'] === 'none solid rgb(204, 0, 0)');
    }
}