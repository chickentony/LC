<?php

namespace Tests\Acceptance\ShoppingCart;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class ShoppingCartCest
{
    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function addProductToCart(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->clickOnCategoryLink($mainPage::CATEGORY_LINK);
        $mainPage->categoryPage->openProduct($mainPage->categoryPage::FIRST_PRODUCT_DIV);
        $mainPage->categoryPage->productPage->clickOnAddProductToCartButton();
//        $I->wait(5);
    }

}