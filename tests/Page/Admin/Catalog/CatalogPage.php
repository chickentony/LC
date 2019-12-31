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

    /** @var AcceptanceTester */
    protected $tester;

    /** @var AddNewProductPage */
    public $addNewProductPage;

    /**
     * CatalogPage constructor.
     * @param AcceptanceTester $tester
     * @param AddNewProductPage $addNewProductPage
     */
    public function __construct(AcceptanceTester $tester, AddNewProductPage $addNewProductPage)
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

}