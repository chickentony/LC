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
    }

}