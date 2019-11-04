<?php

namespace Tests\acceptance\Admin\GeoZones;

use AcceptanceTester;
use Tests\Page\Admin\GeoZones\GeoZonesPage;

class GeoZonesCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/admin');
        $I->fillField('//*[@name="username"]', 'admin');
        $I->fillField('//*[@name="password"]', 'admin');
        $I->click('//*[@name="login"]');
        $I->see('You are now logged in as admin');
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
        $geoZonesPage->openCountryPage();
    }
}