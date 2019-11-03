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
    public function checkGeoZonesSort(AcceptanceTester $I, GeoZonesPage $geoZonesPage)
    {
        $I->amOnPage($geoZonesPage::PAGE_URL);
        $I->waitTillPageLoad($geoZonesPage::PAGE_HEADER);
        $I->checkSortOnPage($geoZonesPage::GEO_ZONE_NAME_FROM_TABLES);


//        $pageData = $I->grabMultiple('//table[@class="dataTable"]//tr[@class="row"]');
//
//        foreach ($pageData as $key => $value) {
//            $result = explode(' ', $value);
//            if (end($result) !== '0') {
//                var_dump(implode($result));
////                 var_dump($result);
////                 var_dump($key);
//            }
////            var_dump($result);
//        }
////        var_dump($pageData);
    }
}