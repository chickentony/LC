<?php

namespace Tests\Page\Main\ShoppingCart;

use AcceptanceTester;

class ShoppingCartPage
{
    public const ITEMS_IN_ORDER = '//table[@class="dataTable rounded-corners"]//tr//td[@class="item"]';

    public const REMOVE_ITEM_FROM_CART_BUTTON = '//*[@name="remove_cart_item"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function getCountOfItemsInCart()
    {
        return count($this->tester->grabMultiple(self::ITEMS_IN_ORDER));
    }

    public function removeItemFromCart()
    {
        $this->tester->waitForElementVisible(self::REMOVE_ITEM_FROM_CART_BUTTON);
        $this->tester->click(self::REMOVE_ITEM_FROM_CART_BUTTON);
    }

    public function waitTillCommonCountOfItemsInCartWillDecrease(int $expectedNumberOfItems, int $timeout)
    {
        $currentNumberOfItems = $this->getCountOfItemsInCart();
        if ($currentNumberOfItems > $expectedNumberOfItems) {
           $this->tester->wait($timeout);
        }
    }

}