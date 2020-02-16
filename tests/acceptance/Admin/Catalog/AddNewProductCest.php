<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Tests\Page\Admin\Catalog\CatalogPage;

class AddNewProductCest
{
    /**
     * @param AcceptanceTester $I
     * @throws \Codeception\Exception\ModuleException
     * Логин в админку
     */
    public function _before(AcceptanceTester $I)
    {
        $I->login();
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