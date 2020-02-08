<?php

namespace Tests\Page\Admin\Catalog;

use AcceptanceTester;

class CatalogPage
{
    /** @var string URL страницы */
    public const PAGE_URL = '/admin/?app=catalog';

    /** @var string Заголовок страницы */
    public const PAGE_HEADER = '//h1[contains(text(),"Catalog")]';

    /** @var string Кнопка добавления нового товара */
    public const ADD_NEW_PRODUCT_BUTTON = '//a[@class="button" and contains(text(),"Add New Product")]';

    public const PRODUCT_CATEGORY_LINKS = [
        'RubberDuck' => '//td//a[text()="Rubber Ducks"]'
    ];

    public const PRODUCTS_LINK = [
        'BlueDuck' => '//td//a[text()="Blue Duck"]'
    ];

    /** @var AcceptanceTester */
    protected $tester;

    /** @var AddNewProductPage */
    public $addNewProductPage;

    /**
     * CatalogPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
        $this->addNewProductPage = new AddNewProductPage($tester);
    }

    /** Нажимает кнопку доабвления нового товара */
    public function clickOnAddNewProductButton()
    {
        $this->tester->click(self::ADD_NEW_PRODUCT_BUTTON);
    }

    /** Получает список всех товаров и каталогов товаров */
    public function getProductList()
    {
        return $this->tester->grabMultiple('//*[@class="row"]');
    }

    public function openProductCategory($category)
    {
        $this->tester->waitForElementVisible($category);
        $this->tester->click($category);
    }

    public function openProduct($product)
    {
        $this->tester->waitForElementVisible($product);
        $this->tester->click($product);
    }

}