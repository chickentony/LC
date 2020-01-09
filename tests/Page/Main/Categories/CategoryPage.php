<?php

namespace Tests\Page\Main\Categories;

use AcceptanceTester;

class CategoryPage
{
    public const FIRST_PRODUCT_DIV = '//div[@class="image-wrapper"]//img[@alt="Purple Duck"]';

    protected $tester;

    public $productPage;

    public function __construct(AcceptanceTester $tester, ProductPage $productPage)
    {
        $this->tester = $tester;
        $this->productPage = $productPage;
    }

    public function openProduct($product)
    {
        $this->tester->moveMouseOver($product);
        $this->tester->click($product);
    }

}