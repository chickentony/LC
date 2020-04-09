<?php

declare(strict_types=1);

namespace Tests\acceptance\Main;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class SaleStickersCest
{
    /**
     * @param AcceptanceTester AcceptanceTester.php
     */
    public function successAuthorization(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->wantTo('Check sale stickers exist');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $mainPage->checkSaleStickersInPopularProdducts();
    }
}