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

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function leftMenuItems(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->waitTillPageLoad($mainPage::LOGOTYPE_IMG);
        $I->assertTrue($mainPage->openItemsAndSubItemsAndCheckThatPagesHasTitles());
    }

}
