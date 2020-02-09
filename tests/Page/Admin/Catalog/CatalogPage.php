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

    /** @var array Ссылка на категорию продуктов */
    public const PRODUCT_CATEGORY_LINKS = [
        'RubberDuck' => '//td//a[text()="Rubber Ducks"]'
    ];

    /** @var string Формат ссылки на продукт */
    public const PRODUCT_LINK_FORMAT = '//td//a[text()="%s"]';

    /** @var array Ссылки на продукты */
    public $productLinks;

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

    /**
     * @param $category
     * @throws \Exception
     * Откроывает категорию с продуктами
     */
    public function openProductCategory($category)
    {
        $this->tester->waitForElementVisible($category);
        $this->tester->click($category);
    }

    /**
     * @param $product
     * @throws \Exception
     * Открывает страницу продукта
     */
    public function openProduct($product)
    {
        $this->tester->waitForElementVisible($product);
        $this->tester->click($product);
    }

    /**
     * @param array $productName
     * Записывает x-Path для ссылок на продукты
     */
    public function setProductXPath(array $productName)
    {
        $result = [];
        $keys = [];
        foreach ($productName as $name) {
            $keys[] = $name;
            $result = array_fill_keys($keys, sprintf(self::PRODUCT_LINK_FORMAT, $name));
        }
        $this->productLinks = $result;
    }
}