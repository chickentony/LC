<?php

namespace Tests\Page\Admin\Catalog;

use AcceptanceTester;

class AddNewProductPage
{
    public const GENERAL_INFORMATION_FIELDS = [
        'PRODUCT_NAME_INPUT' => '//*[@name="name[en]"]',
        'PRODUCT_STATUS_RADIO' => '//*[@name="status"]',
        'PRODUCT_CODE_INPUT' => '//*[@name="code"]',
        'PRODUCT_GROUP_CHECKBOX' => '//*[@value="1-1"]',
        'PRODUCT_QUANTITY_INPUT' => '//*[@name="quantity"]',
        'PRODUCT_IMAGE_FILE' => '//*[@name="new_images[]"]'
    ];

    public const PRODUCT_INFORMATION_TAB = '//a[text()="Information"]';

    public const INFORMATION_FIELDS = [
        'MANUFACTURER_SELECTOR' => '//*[@name="manufacturer_id"]',
        'MANUFACTURE_OPTION' => '//*[@value="1" and text()="ACME Corp."]',
        'SHORT_DESCRIPTION_INPUT' => '//*[@name="short_description[en]"]',
        'DESCRIPTION_TEXTAREA' => '//*[@class="trumbowyg-editor"]',
        'HEAD_TITLE_INPUT' => '//*[@name="head_title[en]"]'
    ];

    public const PRICE_FIELDS = [
        'PURCHASE_PRICE_INPUT' => '//*[@name="purchase_price"]',
        'PURCHASE_PRICE_TYPE_SELECTOR' => '//*[@name="purchase_price_currency_code"]',
        'PURCHASE_PRICE_TYPE_OPTION' => '//*[@value="USD"]',
        'PRICE_INPUT' => '//*[@name="prices[USD]"]'
    ];

    public const PRODUCT_PRICES_TAB = '//a[text()="Prices"]';

    public const SAVE_NEW_PRODUCT_BUTTON = '//*[@name="save"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function fillGeneralProductInformation()
    {
        $this->tester->click(self::GENERAL_INFORMATION_FIELDS['PRODUCT_NAME_INPUT']);
        $this->tester->fillField(self::GENERAL_INFORMATION_FIELDS['PRODUCT_NAME_INPUT'], 'Тестовый товар 1');
        $this->tester->selectOption(self::GENERAL_INFORMATION_FIELDS['PRODUCT_STATUS_RADIO'], 1);
        $this->tester->click(self::GENERAL_INFORMATION_FIELDS['PRODUCT_CODE_INPUT']);
        $this->tester->fillField(self::GENERAL_INFORMATION_FIELDS['PRODUCT_CODE_INPUT'], 777);
        $this->tester->checkOption(self::GENERAL_INFORMATION_FIELDS['PRODUCT_GROUP_CHECKBOX']);
        $this->tester->click(self::GENERAL_INFORMATION_FIELDS['PRODUCT_QUANTITY_INPUT']);
        $this->tester->clearField(self::GENERAL_INFORMATION_FIELDS['PRODUCT_QUANTITY_INPUT']);
        $this->tester->fillField(self::GENERAL_INFORMATION_FIELDS['PRODUCT_QUANTITY_INPUT'], 1);
        $this->tester->attachFile(self::GENERAL_INFORMATION_FIELDS['PRODUCT_IMAGE_FILE'], 'nature1.jpg');
    }

    public function switchToInformationAboutProductTab()
    {
        $this->tester->click(self::PRODUCT_INFORMATION_TAB);
    }

    public function fillProductInformation()
    {
        $this->tester->click(self::INFORMATION_FIELDS['MANUFACTURER_SELECTOR']);
        $this->tester->click(self::INFORMATION_FIELDS['MANUFACTURE_OPTION']);
        $this->tester->click(self::INFORMATION_FIELDS['SHORT_DESCRIPTION_INPUT']);
        $this->tester->fillField(
            self::INFORMATION_FIELDS['SHORT_DESCRIPTION_INPUT'],
            'This is a short description'
        );
        $this->tester->click(self::INFORMATION_FIELDS['DESCRIPTION_TEXTAREA']);
        $this->tester->fillField(self::INFORMATION_FIELDS['DESCRIPTION_TEXTAREA'], 'This is a description');
        $this->tester->click(self::INFORMATION_FIELDS['HEAD_TITLE_INPUT']);
        $this->tester->fillField(self::INFORMATION_FIELDS['HEAD_TITLE_INPUT'], 'This is a head title');
    }

    public function switchToProductPricesTab()
    {
        $this->tester->click(self::PRODUCT_PRICES_TAB);
    }

    public function fillProductPrice()
    {
        $this->tester->click(self::PRICE_FIELDS['PURCHASE_PRICE_INPUT']);
        $this->tester->clearField(self::PRICE_FIELDS['PURCHASE_PRICE_INPUT']);
        $this->tester->fillField(self::PRICE_FIELDS['PURCHASE_PRICE_INPUT'], 20);
        $this->tester->click(self::PRICE_FIELDS['PURCHASE_PRICE_TYPE_SELECTOR']);
        $this->tester->click(self::PRICE_FIELDS['PURCHASE_PRICE_TYPE_OPTION']);
        $this->tester->click(self::PRICE_FIELDS['PRICE_INPUT']);
        $this->tester->clearField(self::PRICE_FIELDS['PRICE_INPUT']);
        $this->tester->fillField(self::PRICE_FIELDS['PRICE_INPUT'], 20);
    }

    public function clickOnSaveNewProductButton()
    {
        $this->tester->click(self::SAVE_NEW_PRODUCT_BUTTON);
    }

}