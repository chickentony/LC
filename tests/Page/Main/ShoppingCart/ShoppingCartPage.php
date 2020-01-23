<?php

namespace Tests\Page\Main\ShoppingCart;

use AcceptanceTester;

class ShoppingCartPage
{
    /** @var string Локатор товара в корзине */
    public const ITEMS_IN_ORDER = '//table[@class="dataTable rounded-corners"]//tr//td[@class="item"]';

    /** @var string Кнопка удаления товара из корзины */
    public const REMOVE_ITEM_FROM_CART_BUTTON = '//*[@name="remove_cart_item"]';

    /** @var AcceptanceTester  */
    protected $tester;

    /**
     * ShoppingCartPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @return int
     * Получает кол-во товаров из корзины
     */
    public function getCountOfItemsInCart()
    {
        return count($this->tester->grabMultiple(self::ITEMS_IN_ORDER));
    }

    /**
     * @throws \Exception
     * Удаляет товар из корзины
     */
    public function removeItemFromCart()
    {
        $this->tester->waitForElementVisible(self::REMOVE_ITEM_FROM_CART_BUTTON);
        $this->tester->click(self::REMOVE_ITEM_FROM_CART_BUTTON);
    }

    /**
     * @param array $quantityItemsToRemove
     * @param int $timeout
     * @throws \Exception
     * Последовательно удаляет товары из корзины, проверя кол-во товаров при каждом удалении
     */
    public function sequentialDeletionItemsFromCart(array $quantityItemsToRemove, int $timeout)
    {
        $currentNumberOfItems = $this->getCountOfItemsInCart();
        foreach ($quantityItemsToRemove as $removingItem) {
            $this->removeItemFromCart();
            $currentNumberOfItems--;
            $this->waitTillCommonCountOfItemsInCartWillDecrease($currentNumberOfItems, $timeout);
            $this->tester->assertEquals($currentNumberOfItems, $this->getCountOfItemsInCart());
        }

    }

    /**
     * @param int $expectedNumberOfItems
     * @param int $timeout
     * Ожидает Что общее кол-во товаров уменьшится на удаленный товар
     */
    private function waitTillCommonCountOfItemsInCartWillDecrease(int $expectedNumberOfItems, int $timeout)
    {
        $currentNumberOfItems = $this->getCountOfItemsInCart();
        if ($currentNumberOfItems > $expectedNumberOfItems) {
            $this->tester->wait($timeout);
        }
    }

}