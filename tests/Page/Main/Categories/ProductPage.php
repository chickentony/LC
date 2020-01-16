<?php

namespace Tests\Page\Main\Categories;

use AcceptanceTester;

class ProductPage
{
    /** @var string Кнопка добавления товара в корзину */
    public const ADD_PRODUCT_TO_CART_BUTTON = '//*[@name="add_cart_product"]';

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * ProductPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     * Добавляет товар в корзину
     */
    public function clickOnAddProductToCartButton()
    {
        $this->tester->click(self::ADD_PRODUCT_TO_CART_BUTTON);
        $this->tester->wait(2);
        $this->tester->closePopup('Error');
        $this->tester->reloadPage();
    }

    /**
     * @param int $iterator
     * @param string $itemsCount
     * Проверяет кол-во добавленных товаров в корзине
     */
    public function checkItemsCountInCart(int $iterator, string $itemsCount)
    {
        $itemsCount = $this->tester->grabTextFrom($itemsCount);
        //ToDO: assert need to be moved in test
        $this->tester->assertEquals((int)$itemsCount, $iterator);
    }

    /**
     * @param string $homeIconXPath
     * Кликает на иконку "Домой"
     */
    public function clickOnHomeIcon(string $homeIconXPath)
    {
        $this->tester->click($homeIconXPath);
    }

}