<?php

namespace Tests\Page\Main\Categories;

use AcceptanceTester;

class ProductPage
{
    /** @var string Кнопка добавления товара в корзину */
    public const ADD_PRODUCT_TO_CART_BUTTON = '//*[@name="add_cart_product"]';

    /** @var string Иконка "Домой" */
    public const HOME_ICON = '//*[@title="Home"]';

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
        // ToDO: think about wait(2)
        $this->tester->wait(2);
        $this->tester->closePopup('Error');
        $this->tester->reloadPage();
    }

    /**
     * @param int $iterator
     * @param string $itemsCountXPath
     */
    public function checkItemsCountInCart(int $iterator, string $itemsCountXPath)
    {
        $count = (int)$this->tester->grabTextFrom($itemsCountXPath);
        //ToDO: assert need to be moved in test
        $this->tester->assertEquals($count, $iterator);
    }

    /** Кликает на иконку "Домой"*/
    public function clickOnHomeIcon()
    {
        $this->tester->click(self::HOME_ICON);
    }

}