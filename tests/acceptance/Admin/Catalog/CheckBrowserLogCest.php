<?php

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Tests\Page\Admin\Catalog\CatalogPage;
use Tests\Page\Admin\Catalog\ProductPage;

class CheckBrowserLogCest
{
    /** @var array Актуальный список продуктов */
    private $productName = ['Blue Duck', 'Green Duck', 'Purple Duck', 'Red Duck', 'Yellow Duck'];

    /**
     * @param AcceptanceTester $I
     * Логин в админку
     */
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
     * @param ProductPage $productPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     * ToDo: ProductPage extend CatalogPage class, there are unnecessary injection of class
     */
    public function checkBrowserLog(AcceptanceTester $I, CatalogPage $catalogPage, ProductPage $productPage)
    {
        $I->wantTo('Check browser log on product page.');
        $I->amOnPage($catalogPage::PAGE_URL);
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        $catalogPage->openProductCategory($catalogPage::PRODUCT_CATEGORY_LINKS['RubberDuck']);
        $catalogPage->setProductXPath($this->productName);
        $productPage->checkBrowserLog($catalogPage->productLinks);
    }

}