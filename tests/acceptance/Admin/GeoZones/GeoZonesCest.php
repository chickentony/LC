<?php

declare(strict_types=1);

namespace Tests\acceptance\Admin\GeoZones;

use AcceptanceTester;
use Tests\Page\Admin\GeoZones\GeoZonesPage;
use Step\Acceptance\Admin;

class GeoZonesCest
{
    /**
     * @param Admin $admin
     * Логин в даминку
     */
    public function _before(Admin $admin): void
    {
        $admin->loginAsAdmin();
    }

    /**
     * @param AcceptanceTester $I
     * @param GeoZonesPage $geoZonesPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkGeoZonesSortIntoCountryPage(AcceptanceTester $I, GeoZonesPage $geoZonesPage): void
    {
        $I->wantTo('Check that geo-zones sorted alphabetically inside country page');
        $I->amOnPage($geoZonesPage::PAGE_URL);
        $I->waitTillPageLoad($geoZonesPage::PAGE_HEADER);
        $geoZonesPage->openGeoZonePageAndCheckSort();
    }
}
