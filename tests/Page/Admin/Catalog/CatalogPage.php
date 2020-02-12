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
     * @param string $category
     * @throws \Exception
     * Открывает категорию с продуктами
     */
    public function openProductCategory(string $category)
    {
        $this->tester->waitForElementVisible($category);
        $this->tester->click($category);
    }

    /**
     * @param string $product
     * @throws \Exception
     * Открывает страницу продукта
     */
    public function openProduct(string $product)
    {
        $this->tester->waitForElementVisible($product);
        $this->tester->click($product);
    }

    /**
     * @param string[] $productNames
     * Записывает x-Path для ссылок на продукты
     */
    public function setProductXPath(array $productNames)
    {
        foreach ($productNames as $name) {
            $this->productLinks[$name] = sprintf(self::PRODUCT_LINK_FORMAT, $name);
        }
    }
}