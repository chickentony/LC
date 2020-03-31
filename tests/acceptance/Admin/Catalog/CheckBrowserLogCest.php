<?php

declare(strict_types=1);

namespace Tests\acceptance\Admin\Catalog;

use AcceptanceTester;
use Step\Acceptance\Admin;
use Tests\Page\Admin\Catalog\CatalogPage;
use Tests\Page\Admin\Catalog\ProductPage;

class CheckBrowserLogCest
{
    /** @var array Актуальный список продуктов */
    private $productNames = ['Blue Duck', 'Green Duck', 'Purple Duck', 'Red Duck', 'Yellow Duck'];

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
     * @param ProductPage $productPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function checkBrowserLogOutput(AcceptanceTester $I, CatalogPage $catalogPage, ProductPage $productPage): void
    {
        $I->wantTo('Check browser log output on product page.');
        $I->amOnPage($catalogPage::PAGE_URL);
        $I->waitTillPageLoad($catalogPage::PAGE_HEADER);
        $catalogPage->openProductCategory($catalogPage::PRODUCT_CATEGORY_LINKS['RubberDuck']);
        $productPage->checkBrowserLogForOutput($this->productNames);
    }

}