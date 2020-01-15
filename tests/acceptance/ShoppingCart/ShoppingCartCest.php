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
        $mainPage->addDifferentProductsToShoppingCart();
        $mainPage->clickOnShoppingCartIcon();
        $totalItemsInCart = $mainPage->shoppingCartPage->getCountOfItemsInCart();
        $I->assertEquals(3, $totalItemsInCart);
        //This must be a loop
        $mainPage->shoppingCartPage->removeItemFromCart();
        $mainPage->shoppingCartPage->waitTillCommonCountOfItemsInCartWillDecrease(2, 2);
        $currentItemsCount = $mainPage->shoppingCartPage->getCountOfItemsInCart();
        $I->assertEquals(2, $currentItemsCount);
//        $I->wait(5);
    }

}