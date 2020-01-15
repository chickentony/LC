<?php

namespace Tests\Page\Main\Categories;

use AcceptanceTester;

class ProductPage
{
    public const ADD_PRODUCT_TO_CART_BUTTON = '//*[@name="add_cart_product"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function clickOnAddProductToCartButton()
    {
        $this->tester->click(self::ADD_PRODUCT_TO_CART_BUTTON);
        $this->tester->wait(2);
        $this->tester->closePopup('Error');
        $this->tester->reloadPage();
    }

    public function checkItemsCountInCart(int $iterator, string $itemsCount)
    {
        $itemsCount = $this->tester->grabTextFrom($itemsCount);
        //ToDO: assert need to be moved in test
        $this->tester->assertEquals((int)$itemsCount, $iterator);
    }

    public function clickOnHomeIcon(string $homeIconXPath)
    {
        $this->tester->click($homeIconXPath);
    }

}