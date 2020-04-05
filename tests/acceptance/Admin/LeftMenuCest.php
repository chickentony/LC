<?php

declare(strict_types=1);

namespace Tests\acceptance\Admin;

use AcceptanceTester;
use Step\Acceptance\Admin;
use Tests\Page\Admin\Main\MainPage;

class LeftMenuCest
{
    public function _before(Admin $admin): void
    {
        $admin->loginAsAdmin();
    }

    public function leftMenuItems(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->waitTillPageLoad($mainPage::LOGOTYPE_IMG);
        $mainPage->openItemsAndSubItemsAndCheckHeaders();
    }

}