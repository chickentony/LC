<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Tests\Page\Admin\Catalog\CatalogPage;

class CheckBrowserLogCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/admin');
        $I->fillField('//*[@name="username"]', 'admin');
        $I->fillField('//*[@name="password"]', 'admin');
        $I->click('//*[@name="login"]');
        $I->see('You are now logged in as admin');
    }

    /**
     * @param AcceptanceTester $I
     * @param CatalogPage $catalogPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkBrowserLog(AcceptanceTester $I, CatalogPage $catalogPage)
    {
        $I->wantTo('Check browser log on product page.');
        $I->amOnPage($catalogPage::PAGE_URL);
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        $catalogPage->openProductCategory($catalogPage::PRODUCT_CATEGORY_LINKS['RubberDuck']);
        $catalogPage->openProduct($catalogPage::PRODUCTS_LINK['BlueDuck']);
        $browserLog = $I->getBrowserLog();
        var_dump($browserLog);
//        $I->wait(3);
    }

}