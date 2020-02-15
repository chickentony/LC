<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Tests\Page\Admin\Catalog\CatalogPage;
use Tests\Page\Admin\Catalog\ProductPage;

class CheckBrowserLogCest
{
    /** @var array Актуальный список продуктов */
    private $productNames = ['Blue Duck', 'Green Duck', 'Purple Duck', 'Red Duck', 'Yellow Duck'];

    /**
     * @param AcceptanceTester $I
     * Логин в админку
     * @throws \Codeception\Exception\ModuleException
     */
    public function _before(AcceptanceTester $I)
    {
        $I->login();
    }

    /**
     * @param AcceptanceTester $I
     * @param CatalogPage $catalogPage
     * @param ProductPage $productPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     * ToDo: ProductPage extend CatalogPage class, there are unnecessary injection of class
     */
    public function checkBrowserLogOutput(AcceptanceTester $I, CatalogPage $catalogPage, ProductPage $productPage)
    {
        $I->wantTo('Check browser log output on product page.');
        $I->amOnPage($catalogPage::PAGE_URL);
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        $catalogPage->openProductCategory($catalogPage::PRODUCT_CATEGORY_LINKS['RubberDuck']);
        $catalogPage->setProductXPath($this->productNames);
        $productPage->checkBrowserLogForOutput($catalogPage->productLinks);
    }

}