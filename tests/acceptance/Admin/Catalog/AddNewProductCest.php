<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Tests\Page\Admin\Catalog\CatalogPage;

class AddNewProductCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/admin');
        $I->fillField('//*[@name="username"]', 'admin');
        $I->fillField('//*[@name="password"]', 'admin');
        $I->click('//*[@name="login"]');
        $I->see('You are now logged in as admin');
    }

    public function addNewProduct(AcceptanceTester $I, CatalogPage $catalogPage)
    {
        $I->amOnPage($catalogPage::PAGE_URL);
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        $catalogPage->clickOnAddNewProductButton();
        $catalogPage->addNewProductPage->fillGeneralProductInformation();
        $catalogPage->addNewProductPage->switchToInformationAboutProductTab();
        $catalogPage->addNewProductPage->fillProductInformation();
        $catalogPage->addNewProductPage->switchToProductPricesTab();
        $catalogPage->addNewProductPage->fillProductPrice();
        $catalogPage->addNewProductPage->clickOnSaveNewProductButton();
//        $I->wait(5);
    }

}