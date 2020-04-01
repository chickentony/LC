<?php

declare(strict_types=1);

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
    public function clickOnAddProductToCartButton(): void
    {
        $this->tester->click(self::ADD_PRODUCT_TO_CART_BUTTON);
        // При добавлении товара в корзину нет никакой анимации, иногда ничего не остается, кроме wait
        $this->tester->wait(2);
        $this->tester->closePopup('Error');
        $this->tester->reloadPage();
    }

    /**
     * @param int $iterator
     * @param string $itemsCountXPath
     * @throws \Exception
     * ToDo: общик exception для подобного рода проверок
     */
    public function checkItemsCountInCart(int $iterator, string $itemsCountXPath): void
    {
        $count = (int)$this->tester->grabTextFrom($itemsCountXPath);
        if ($count !== $iterator) {
            throw new \Exception('Number of adding items and items in cart are not same');
        }
    }

    /** Кликает на иконку "Домой"*/
    public function clickOnHomeIcon(): void
    {
        $this->tester->click(self::HOME_ICON);
    }
}
