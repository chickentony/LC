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
     * @throws \Exception
     */
    public function addProductToCart(AcceptanceTester $I, MainPage $mainPage)
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $mainPage->addDifferentProductsToShoppingCart();
        $mainPage->clickOnShoppingCartIcon();
        $totalItemsInCart = $mainPage->shoppingCartPage->getCountOfItemsInCart();
        $I->assertEquals(3, $totalItemsInCart);
        $mainPage->shoppingCartPage->sequentialDeletionItemsFromCart($mainPage->categoryPage::PRODUCT_LIST, 1);
        $I->see('There are no items in your cart.');
    }
}