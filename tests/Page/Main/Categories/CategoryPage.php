<?php

namespace Tests\Page\Main\Categories;

use AcceptanceTester;

class CategoryPage
{
    /** @var array Список товаров в категории */
    public const PRODUCT_LIST = [
        'GREEN_DUCK' => '//div[@class="image-wrapper"]//img[@alt="Green Duck"]',
        'RED_DUCK' => '//div[@class="image-wrapper"]//img[@alt="Red Duck"]',
        'BLUE_DUCK' => '//div[@class="image-wrapper"]//img[@alt="Blue Duck"]'
    ];

    /** @var AcceptanceTester */
    protected $tester;

    /** @var ProductPage */
    public $productPage;

    /**
     * CategoryPage constructor.
     * @param AcceptanceTester $tester
     * @param ProductPage $productPage
     */
    public function __construct(AcceptanceTester $tester, ProductPage $productPage)
    {
        $this->tester = $tester;
        $this->productPage = $productPage;
    }

    /**
     * @param string $productXPath
     * Открывает страницу конкретного товара
     */
    public function openProduct(string $productXPath)
    {
        $this->tester->moveMouseOver($productXPath);
        $this->tester->click($productXPath);
    }

}