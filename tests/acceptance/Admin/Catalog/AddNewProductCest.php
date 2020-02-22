<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Step\Acceptance\Admin;
use Tests\Page\Admin\Catalog\CatalogPage;

class AddNewProductCest
{
    /**
     * @param Admin $admin
     * Логин в даминку
     */
    public function _before(Admin $admin)
    {
        $admin->loginAsAdmin();
    }

    /**
     * @param AcceptanceTester $I
     * @param CatalogPage $catalogPage
     * @throws \Codeception\Exception\ModuleException
     */
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
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        // Проверяем, что наш товар добавился в конец общего спсика.
        $productList = $catalogPage->getProductList();
        $I->assertEquals('Тестовый товар 1', end($productList));
    }

}