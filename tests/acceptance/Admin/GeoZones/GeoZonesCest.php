<?php

namespace Tests\acceptance\Admin\GeoZones;

use AcceptanceTester;
use Tests\Page\Admin\GeoZones\GeoZonesPage;

class GeoZonesCest
{
    /**
     * @param AcceptanceTester $I
     * @throws \Codeception\Exception\ModuleException
     */
    public function _before(AcceptanceTester $I)
    {
        $I->login();
    }

    /**
     * @param AcceptanceTester $I
     * @param GeoZonesPage $geoZonesPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkGeoZonesSortIntoCountryPage(AcceptanceTester $I, GeoZonesPage $geoZonesPage)
    {
        $I->wantTo('Check that geo-zones sorted alphabetically inside country page');
        $I->amOnPage($geoZonesPage::PAGE_URL);
        $I->waitTillPageLoad($geoZonesPage::PAGE_HEADER);
        $geoZonesPage->openGeoZonePageAndCheckSort();
    }
}