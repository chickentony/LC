<?php

namespace Tests\Page\Admin\Catalog;

use AcceptanceTester;

class CatalogPage
{
    public const PAGE_URL = '/admin/?app=catalog';

    public const PAGE_HEADER = '//h1[contains(text(),"Catalog")]';

    public const ADD_NEW_PRODUCT_BUTTON = '//a[@class="button" and contains(text(),"Add New Product")]';

    public const GENERAL_INFORMATION_FIELDS = [
        'PRODUCT_NAME' => '//*[@name="name[en]"]',
        'PRODUCT_STATUS' => '//*[@name="status"]'
    ];

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function clickOnAddNewProductButton()
    {
        $this->tester->click(self::ADD_NEW_PRODUCT_BUTTON);
    }

    public function fillGeneralProductInformation()
    {
        $this->tester->fillField(self::GENERAL_INFORMATION_FIELDS['PRODUCT_NAME'], 'Тестовый товар 1');
        $this->tester->selectOption(self::GENERAL_INFORMATION_FIELDS['PRODUCT_STATUS'], 1);
    }

}