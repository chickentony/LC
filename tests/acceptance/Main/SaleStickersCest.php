<?php

declare(strict_types=1);

namespace Tests\acceptance\Main;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class SaleStickersCest
{
    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     */
    public function checkAvailabilityOfSaleStickers(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->wantTo('Check sale stickers exist');
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->assertTrue($mainPage->checkAvailabilitySaleStickersInPopularProducts());
        $I->assertTrue($mainPage->checkAvailabilitySaleStickersInCampaignsProducts());
        $I->assertTrue($mainPage->checkAvailabilitySaleStickersInLatestProducts());
    }
}
