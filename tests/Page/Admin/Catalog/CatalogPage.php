<?php

namespace Tests\Page\Admin\Catalog;

use AcceptanceTester;

class CatalogPage
{
    public const PAGE_URL = '/admin/?app=catalog';

    public const PAGE_HEADER = '//h1[contains(text(),"Catalog")]';

    public const ADD_NEW_PRODUCT_BUTTON = '//a[@class="button" and contains(text(),"Add New Product")]';

    protected $tester;

    public $addNewProductPage;

    public function __construct(AcceptanceTester $tester, AddNewProductPage $addNewProductPage)
    {
        $this->tester = $tester;
        $this->addNewProductPage = new AddNewProductPage($tester);
    }

    public function clickOnAddNewProductButton()
    {
        $this->tester->click(self::ADD_NEW_PRODUCT_BUTTON);
    }

}